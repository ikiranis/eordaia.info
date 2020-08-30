<template>
    <div>
        <img :src="imageDisplayed" width="100%" height="auto"
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
                imageDisplayed: ''
            }
        },

        props: {
            photo: {
                required: true,
                type: Object
            }
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
