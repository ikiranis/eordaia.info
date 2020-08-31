<template>
    <div>
        <b-modal ref="photoModal" size="md" centered scrollable hide-footer title="Επιλογή φωτογραφίας">


            <template v-slot:modal-header="{ close }">
                    <label class="sr-only"
                           for="search">Search</label>
                    <input id="search" name="search" class="my-2 col-lg-6 col-12 mx-auto"
                           v-model="search" placeholder="Αναζήτηση">
            </template>



            <div v-for="(photo, index) in filteredPhotos" class="row mb-3">
                <div class="col-4">
                    <img :src="photo.smallPhotoUrl">
                </div>

                <div class="col-8 my-auto">
                    <div>{{ photo.description }}</div>
                    <button class="btn btn-success col-6 my-2 mx-auto" type="button"
                            @click="chooseThePhoto(photo)">Επιλογή
                    </button>
                </div>
            </div>

        </b-modal>

        <div class="col-lg col-12 row fixed-bottom mb-5">
            <loading class="mx-auto" :loading="loading"/>
        </div>

        <div v-for="(photo, index) in photos"
             class="my-3 px-3 py-1 border row"
             :class="photo.photoUploaded ? 'bg-light-success' : ''">
            <div v-if="photo.preview || photo.smallPhotoUrl" class="my-auto col-12 col-lg-auto">
                <div class="btn-sm"
                     :class="(photo.id === image_id ) ? 'image-selected' : ''"
                     @click="chooseCover(index)">
                    <img v-if="photo.preview" :src="photo.preview.src" class="mx-auto" width="150" height="auto" />

                    <img v-else :src="photo.smallPhotoUrl" class="mx-auto" width="150" height="auto" />
                </div>
            </div>

            <div class="col-12 col-lg my-auto">
                <div v-if="!photo.photoUploaded" class="row">
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
                           for="photoReferral">Πηγή</label>
                    <input id="photoReferral" name="referral" class="my-2 col-12 mx-auto"
                              v-model="photo.referral" placeholder="Πηγή">
                    <form-error v-if="response.errors.referral"
                                :error="response.errors.referral[0]"
                                class="mx-auto col-12"/>
                </div>

                <div class="row">
                    <label class="sr-only"
                           for="photoDescription">Περιγραφή</label>
                    <textarea id="photoDescription" name="description" class="my-2 col-12 mx-auto"
                              v-model="photo.description" placeholder="Περιγραφή"/>
                    <form-error v-if="response.errors.description"
                                :error="response.errors.description[0]"
                                class="mx-auto col-12"/>
                </div>

                <div v-if="!photo.photoUploaded">
                    <label for="viewable">Εμφάνιση περιγραφής</label>

                    <input type="checkbox" id="viewable" name="viewable" v-model="photo.viewable" :checked="photo.viewable ? 'checked' : ''">
                </div>

                <div class="row">
                    <button v-if="!photo.photoUploaded"
                            class="btn btn-success col-12 col-lg-5 my-2 mx-auto" type="button"
                            @click="uploadPhoto(index)">Upload
                    </button>

                    <button class="btn btn-danger col-12 col-lg-5 my-2 mx-auto" type="button"
                            @click="removePhoto(index)">Remove
                    </button>
                </div>
            </div>

        </div>

        <div class="row col-12">
            <button class="btn btn-success mx-auto col-5"
                    type="button"
                    @click="addPhoto">Προσθήκη φωτογραφίας
            </button>

            <button class="btn btn-warning mx-auto col-5"
                    type="button"
                    @click="choosePhoto">Επιλογή φωτογραφίας
            </button>
        </div>

        <input type="hidden" v-for="photo in photos" name="photos[]" :value="photo.id">
        <input type="hidden" name="image_id" :value="image_id">

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
                referral: '',
                description: '',
                preview: null,
                photoUrl: '',
                smallPhotoUrl: '',
                photoUploaded: false,
                viewable: false
            },

            photosList: [],

            search: ''
        }
    },

    props: {
        photos: {
            required: true,
            type: Array
        },

        image_id: {
            required: true,
            type: String
        }
    },

    computed: {
        filteredPhotos() {
            if (this.search.length > 0) {
                return this.photosList.filter((photo) => {
                    if (photo.description) {
                        return photo.description.toUpperCase().includes(this.search.toUpperCase())
                    }
                })
            }

            return this.photosList
        }
    },

    methods: {
        addPhoto() {
            // Have to push this.emptyPhoto like this. Otherwise this.emptyPhoto copied by reference and
            // the object properties will change when this.photos[] change
            this.photos.push(Object.assign({}, this.emptyPhoto))
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
                    photoUrl: null,
                    smallPhotoUrl: null,
                    photoUploaded: false
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
            formData.append('referral', this.photos[index].referral)
            formData.append('viewable', this.photos[index].viewable ? '1' : '0')

            this.loading = true

            axios.post('/api/photo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    Object.assign(this.photos[index], {
                        id: response.data.id,
                        photoUploaded: true
                    })

                    this.response.message = "Η φωτογραφία ανέβηκε..."
                    this.response.status = true

                    this.loading = false
                })
                .catch(error => {
                    this.loading = false

                    this.response.message = 'Υπάρχει πρόβλημα με τα δεδομένα που έδωσες'
                    this.response.status = false
                    this.response.errors = error.response.data.errors
                })
        },

        deletePhoto(index, id) {
            this.loading = true

            axios.delete('/api/photo/' + id)
                .then(response => {
                    this.response.message = "Η φωτογραφία διαγράφηκε..."
                    this.response.status = true

                    this.photos.splice(index, 1)

                    this.loading = false
                })
                .catch(error => {
                    this.response.message = 'Υπάρχει πρόβλημα με τα δεδομένα που έδωσες'
                    this.response.status = false
                    this.response.errors = error.response.data.errors

                    this.loading = false
                })
        },

        choosePhoto() {
            this.$refs.photoModal.show()
            this.getPhotos()
        },

        getPhotos() {
            this.loading = true

            axios.get('/api/photos')
                .then(response => {
                    this.photosList = response.data;

                    this.loading = false
                })
                .catch(error => {
                    this.response.message = 'Δεν βρέθηκαν φωτογραφίες'
                    this.response.status = false
                    this.response.errors = error.response.data.errors

                    this.loading = false
                })
        },

        chooseThePhoto(photo) {
            this.$refs.photoModal.hide()

            photo.photoUploaded = true
            this.photos.push(photo)

        },

        removePhoto(index) {
            this.photos.splice(index, 1)
        },

        chooseCover(index) {
            this.image_id = this.photos[index].id
        }
    }
}
</script>
