<template>
    <div>
        <img :srcset="photo.smallPhotoUrl + ' 150w,'
             + photo.mediumPhotoUrl + ' 500w,'
             + photo.largePhotoUrl + ' 1000w,'
             + photo.photoUrl + ' 1500w'"
             :src="photo.mediumPhotoUrl"
             class="card-img mb-1">

        {{ modalClasses }}
    </div>
</template>

<script>
    export default {
        data() {
            return {
                photo: {}
            }
        },

        props: {
            id: {
                required: true,
                type: String
            }
        },

        computed: {
            modalClasses() {
                return document.querySelector('#imageModal' + this.id).classList
            }
        },

        watch: {
            // modalClasses() {
            //     // if (this.modalClasses.contains('show')) {
            //         console.log('hello')
            //     // }
            // }
        },

        created() {
            this.updateMessage()
        },


        methods: {
            updateMessage() {
                setInterval(() => {
                        console.log(document.querySelector('#imageModal' + this.id).classList)
                }, 3000)

            },

            getPhoto() {
                axios.get('/api/photo/' + this.id)
                    .then(response => {
                        this.photo = response.data;

                        console.log(this.photo)
                    })
                    .catch(error => {
                        console.log(error.response.data)
                    })
            },
        }

    }
</script>
