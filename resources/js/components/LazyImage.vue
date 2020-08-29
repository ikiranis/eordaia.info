<template>
    <div>
        <b-img-lazy v-if="photo"
                    :srcset="srcset"
                    :blank-src="photo.smallPhotoUrl"
                    :src="photo.mediumPhotoUrl"
                    sizes="(min-width: 940px) 66vw,
                                    100vw"
                    width="100%"
                    class="card-img mb-1"
                    rel="preload"
                    :alt="photo.label"></b-img-lazy>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                photo: null,
                srcset: []
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
                axios.get('/api/photo/' + this.id)
                    .then(response => {
                        this.photo = response.data

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
            }
        }

    }
</script>
