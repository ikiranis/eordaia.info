<template>
    <div>
        <b-modal ref="photoModal" hide-footer size="lg" centered>

            <img v-if="photo"
                        :srcset="srcset"
                        :src="photo.mediumPhotoUrl"
                        class="card-img mb-1"
                        :alt="photo.label">

        </b-modal>

        <div v-if="thumb" class="coverImage"  @click="showModal">
            <div>
                <b-img-lazy :srcset="thumbSrcSet"
                    :src="thumb.mediumPhotoUrl"
                     class="btn" fluid-grow
                     :blank-src="thumb.preloadUrl ? thumb.preloadUrl : thumb.smallPhotoUrl"
                    :alt="thumb.label" />
            </div>

            <div v-if="thumb.label !== '' || referral !== ''" class="photoLabel row mx-3 px-3 mb-1">
                <div class="mx-auto row text-center">
                    <span class="description px-2 col-md-auto col-12 mx-md-auto">{{ thumb.label }}</span>
                    <span class="col-md-auto col-12 mx-md-auto"><a :href="thumb.referral">{{ referral }}</a></span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                thumb: null,
                photo: null,
                srcset: []
            }
        },

        props: {
            id: {
                required: true,
                type: String
            },

            referral: {
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

<style scoped>
    .coverImage {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>
