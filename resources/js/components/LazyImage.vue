<template>
    <div>
        <img :src="imageDisplayed" class="card-img mb-1">

        <img
                    :srcset="srcset"
                    :src="photo.mediumPhotoUrl"
                    sizes="(min-width: 940px) 66vw,
                                    100vw"
                    :id="id"
                    class="card-img mb-1 coverImage"
                    :alt="photo.label" @load="imageUploaded">
    </div>

</template>

<script>
    export default {
        data() {
            return {
                photo: null,
                srcset: [],
                imageDisplayed: '',
                displayTheImage: false
            }
        },

        props: {
            id: {
                required: true,
                type: String
            }
        },

        mounted() {
            this.getPhoto()
        },

        methods: {
            getPhoto() {
                console.log(this.id)
                axios.get('/api/photo/' + this.id)
                    .then(response => {
                        this.photo = response.data

                        this.srcset = [
                            this.photo.smallPhotoUrl + ' 150w',
                            this.photo.mediumPhotoUrl + ' 1000w',
                            this.photo.largePhotoUrl + ' 1500w',
                            this.photo.photoUrl + ' 2000w'
                        ]

                        this.imageDisplayed = this.photo.smallPhotoUrl
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },

            imageUploaded() {
                let imgElement = document.querySelector('#' + this.id)

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
