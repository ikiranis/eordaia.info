<template>
    <div>
        <img :srcset="photo.smallPhotoUrl + ' 150w,'
             + photo.mediumPhotoUrl + ' 500w,'
             + photo.largePhotoUrl + ' 1000w,'
             + photo.photoUrl + ' 1500w'"
             :src="photo.mediumPhotoUrl"
             class="card-img mb-1">
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

        created() {
            this.getPhoto()
        },

        methods: {
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
