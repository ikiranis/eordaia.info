<template>
    <div>
        <img :src="imageDisplayed" class="card-img mb-1"
             :title="photo.title">

        <img :srcset="photo.srcset"
            :src="photo.fallback"
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
