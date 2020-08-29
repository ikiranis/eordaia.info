<template>
    <div>
        <b-modal ref="photoModal" hide-footer size="lg" centered>

            <img v-if="photo"
                        :srcset="srcset"
                        :src="photo.mediumPhotoUrl"
                        sizes="(min-width: 940px) 66vw,
                                    100vw"
                        class="card-img mb-1"
                        :alt="photo.label">

        </b-modal>

        <div v-if="thumb" @click="showModal">
            <img :srcset="thumbSrcSet"
                :src="thumb.mediumPhotoUrl"
                sizes="(min-width: 940px) 66vw,
                            100vw"
                class="card-img mb-1 btn"
                :alt="thumb.label">
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                thumb: {},
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

        computed: {
            thumbSrcSet() {
                return [
                    this.thumb.smallPhotoUrl + ' 150w',
                    this.thumb.mediumPhotoUrl + ' 1000w',
                    this.thumb.largePhotoUrl + ' 1500w'
                ]
            }
        },

        mounted() {
            this.getPhoto()
        },

        methods: {
            getPhoto() {
                axios.get('/api/photo/' + this.id)
                    .then(response => {
                        this.thumb = response.data
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },

            showModal() {
                this.photo = this.thumb

                this.srcset = [
                    this.photo.smallPhotoUrl + ' 150w',
                    this.photo.mediumPhotoUrl + ' 1000w',
                    this.photo.largePhotoUrl + ' 1500w',
                    this.photo.photoUrl + ' 2000w'
                ]

                this.$refs.photoModal.show()
            }
        }

    }
</script>
