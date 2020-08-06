<template>
    <div>
        <div class="col-lg col-12 row fixed-bottom mb-5">
            <loading class="mx-auto" :loading="loading"/>
        </div>

        <div v-for="(photo, index) in photos" class="my-3 px-1 py-1 border">
            <div class="row">
                <div class="form-group my-3 col-lg-6 col-12 mx-auto">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"
                               name="uploadFile" id="uploadFile"
                               accept='image/*'
                               @change="handleFile($event, index)">
                        <label class="custom-file-label"
                               for="uploadFile">Φωτογραφία</label>

                        <form-error v-if="response.errors.file"
                                    :error="response.errors.file[0]"/>
                    </div>
                </div>

            </div>

            <div class="row">
                <label class="sr-only"
                       for="photoDescription">Περιγραφή</label>
                <textarea id="photoDescription" name="description" class="my-2 col-lg-8 col-12 mx-auto"
                          v-model="photo.description" placeholder="Περιγραφή"/>
                <form-error v-if="response.errors.description"
                            :error="response.errors.description[0]"
                            class="mx-auto col-lg-8 col-12"/>
            </div>

            <div v-if="photo.preview || photo.photoUrl" class="row col-12">
                <img v-if="photo.preview" :src="photo.preview.src" class="mx-auto" width="350"/>

                <img v-else :src="photo.photoUrl" class="mx-auto" width="350"/>
            </div>

            <div class="row">
                <button class="btn btn-success col-6 my-2 mx-auto" type="button"
                        @click="uploadPhoto(index)">Upload
                </button>
            </div>

            <div class="row">
                <button class="btn btn-danger col-6 my-2 mx-auto" type="button"
                        @click="deletePhoto(photo.id)">Delete
                </button>
            </div>

        </div>

        <div class="row col-12">
            <button class="btn btn-success mx-auto"
                    type="button"
                    @click="addPhoto">Προσθήκη φωτογραφίας
            </button>
        </div>

        <input type="hidden" v-for="photo in photos" name="photos[]" :value="photo.id">

        <div class="row fixed-bottom mb-2">
            <display-error class="mx-auto"
                           v-if="response.message"
                           :response="response"/>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            response: {
                message: ' ',
                status: '',
                errors: []
            },

            loading: false,

            emptyPhoto: {
                id: null,
                file: null,
                description: '',
                preview: null,
                photoUrl: ''
            }
        }
    },

    props: {
        photos: {
            required: true,
            type: Array
        }
    },

    created() {
        // console.log(this.photos)
    },

    methods: {
        addPhoto() {
            this.photos.push(this.emptyPhoto)
        },

        handleFile(event, index) {
            const preview = document.createElement("img")
            const file = event.target.files[0]
            const reader = new FileReader()

            reader.addEventListener("load", () => {
                // convert image file to base64 string
                preview.src = reader.result

                Object.assign(this.photos[index], {
                    file: file,
                    preview: preview,
                    photoUrl: null
                })
            }, false)

            if (file) {
                reader.readAsDataURL(file)
            }
        },

        uploadPhoto(index) {
            let formData = new FormData()
            formData.append('file', this.photos[index].file)
            formData.append('url', this.photos[index].url)
            formData.append('description', this.photos[index].description)

            this.loading = true

            axios.post('/api/photo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    Object.assign(this.photos[index], {
                        id: response.data.id
                    })

                    this.response.message = "Η φωτογραφία ανέβηκε..."
                    this.response.status = true

                    this.loading = false
                })
                .catch(error => {
                    this.response.message = 'Υπάρχει πρόβλημα με τα δεδομένα που έδωσες'
                    this.response.status = false
                    this.response.errors = error.response.data.errors

                    this.loading = false
                })
        },

        deletePhoto(index) {
            this.loading = true

            axios.delete('/api/photo/' + index)
                .then(response => {
                    this.response.message = "Η φωτογραφία διαγράφηκε..."
                    this.response.status = true

                    this.loading = false
                })
                .catch(error => {
                    this.response.message = 'Υπάρχει πρόβλημα με τα δεδομένα που έδωσες'
                    this.response.status = false
                    this.response.errors = error.response.data.errors

                    this.loading = false
                })
        }

    }
}
</script>
