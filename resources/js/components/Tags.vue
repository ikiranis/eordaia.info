<template>
    <div>
        <div class="input-group mb-3 no-gutters">
            <label class="sr-only" for="tag">Tag</label>
            <div class="input-group-prepend col-2">
                <span class="input-group-text w-100">Tag</span>
            </div>
            <input type="text" max="255" v-model="tag" class="form-control col-8 px-2"
                   id="tag" name="tag">

            <span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>

            <input type="hidden" v-for="tag in tags" name="tags[]" :value="tag.id">

        </div>

        <div class="my-2 row">
            <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="tag in tags">{{ tag.name }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tag: ''
            }
        },

        props: {
            tags: {
                required: true,
                type: Array
            },
        },

        methods: {
            insertTag() {
                let myData = {
                    name: this.tag
                }

                axios.post('/api/tag', myData)
                    .then(response => {
                        this.tags.push({id: response.data.id, name: response.data.name})
                        this.tag = ''
                    })
                    .catch(e => console.log(e))
            }
        }
    }
</script>
