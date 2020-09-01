<template>
    <div>
        <img :src="imageDisplayed" width="100%" height="100%"
             :title="photo.title" :alt="photo.title">

        <img :srcset="photo.srcset"
            :src="photo.fallback"
            :sizes="photo.sizes"
            ref="image" class="preloadedImage"
            @load="imageUploaded">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                imageDisplayed: '',
                imageHeight: ''
            }
        },

        props: {
            photo: {
                required: true,
                type: Object
            }
        },

        computed: {
            // imageHeight() {
            //     return this.photo.ratio ? (1000 / this.photo.ratio) : 'auto'
            // }
        },

        beforeMount() {
            // console.log(this.photo.ratio)
            // let postContainerWidth = document.querySelector('article').offsetWidth
            // this.imageHeight = parseInt(postContainerWidth / this.photo.ratio) + 'px'
        },

        created() {
            this.imageDisplayed = this.photo.preload
        },

        methods: {
            imageUploaded() {
                this.imageDisplayed =  this.$refs.image.currentSrc
            }
        }

    }
</script>

<style scoped>
    .preloadedImage {
        display: none;
    }
</style>
