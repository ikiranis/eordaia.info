<template>
    <div>
        <img :src="imageDisplayed" class="card-img mb-1"
             :title="title">

        <img :srcset="srcset"
            :src="photo.medium"
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
            },

            title: {
                required: true,
                type: String
            }
        },

        computed: {
            srcset() {
                return [
                    this.photo.small + ' 150w',
                    this.photo.medium + ' 1000w',
                    this.photo.large + ' 1500w',
                    this.photo.original + ' 2000w'
                ]
            }
        },

        created() {
            this.imageDisplayed = this.photo.small
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
