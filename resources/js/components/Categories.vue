<template>
    <div>
        <div class="input-group mb-3 no-gutters">
            <label class="sr-only" for="category">Νέα κατηγορία</label>
            <div class="input-group-prepend col-2">
                <span class="input-group-text w-100">Νέα κατηγορία</span>
            </div>
            <input type="text" max="255" v-model="category" class="form-control col-8 px-2"
                   id="category" name="category">

            <span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>

            <input type="hidden" v-for="category in categories" name="categories[]" :value="category.id">

        </div>

        <div class="my-2 row">
            <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="category in categories">{{ category.name }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: ''
            }
        },

        props: {
            categories: {
                required: true,
                type: Array
            },
        },

        methods: {
            insertTag(e) {
                let myData = {
                    name: this.category
                }

                axios.post('/api/catagory', myData)
                    .then(response => {
                        this.categories.push({id: response.data.id, name: response.data.name})
                        this.category = ''
                    })
                    .catch(e => console.log(e))
            }
        }
    }
</script>
