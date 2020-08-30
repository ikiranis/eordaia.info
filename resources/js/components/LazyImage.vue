<template>
    <div>
        <img :src="imageDisplayed" class="card-img mb-1"
             :title="label">

        <img v-if="photo"
                    :srcset="srcset"
                    :src="photo.mediumPhotoUrl"
                    sizes="(min-width: 940px) 66vw,
                                    100vw"
                    :id="'id-' + photo.id"
                    class="coverImage"
                    @load="imageUploaded">
    </div>

</template>

<script>
    export default {
        data() {
            return {
                photo: null,
                srcset: [],
                imageDisplayed: ''
            }
        },

        props: {
            id: {
                required: true,
                type: String
            },

            title: {
                required: true,
                type: String
            }
        },

        computed: {
            label() {
                if (this.photo) {
                    return this.photo.label ? this.photo.label : this.title
                }

                return ''
            }
        },

        mounted() {
            this.getPhoto()
        },

        methods: {
            getPhoto() {
                axios.get('/api/photo/' + this.id)
                    .then(response => {
                        this.photo = response.data

                        this.imageDisplayed = this.photo.smallPhotoUrl

                        this.srcset = [
                            this.photo.smallPhotoUrl + ' 150w',
                            this.photo.mediumPhotoUrl + ' 1000w',
                            this.photo.largePhotoUrl + ' 1500w',
                            this.photo.photoUrl + ' 2000w'
                        ]
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },

            imageUploaded() {
                let imgElement = document.querySelector('#id-' + this.photo.id)

                this.displayTheImage = true
                this.imageDisplayed =  imgElement.currentSrc
            }
        }

    }
</script>

<style scoped>
    .coverImage {
        display: none;
    }
</style>
