<template>
    <div>
        <div class="input-group mb-3 no-gutters">
            <div class="col-lg col-12 row fixed-bottom mb-5">
                <loading class="mx-auto" :loading="loading"/>
            </div>

            <label class="sr-only" for="tag">Tag</label>
            <div class="input-group-prepend col-2">
                <span class="input-group-text w-100">Tag</span>
            </div>
            <input type="text" v-model="tag" class="form-control col-8 px-2"
                   id="tag" maxlength="40" name="tag">

            <span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>

            <form-error v-if="response.errors.name"
                        :error="response.errors.name[0]" />

            <input type="hidden" v-for="tag in tags" name="tags[]" :value="tag.id">
        </div>

        <div class="my-2 row">
            <span v-for="(tag, index) in tags"
                  class="my-1 mx-2 px-2 bg-primary text-light tag"
                  title="Αφαίρεση tag"
                  @click="removeTag(index)">{{ tag.name }}</span>
        </div>

        <div class="row fixed-bottom mb-2">
            <display-error class="mx-auto"
                           v-if="response.message"
                           :response="response"/>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                response: {
                    message: ' ',
                    status: '',
                    errors: []
                },

                loading: false,

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
                this.loading = false

                let myData = {
                    name: this.tag
                }

                axios.post('/api/tag', myData)
                    .then(response => {
                        this.tags.push({id: response.data.id, name: response.data.name})
                        this.tag = ''

                        this.response.message = "To tag καταχωρήθηκε"
                        this.response.status = true

                        this.loading = false
                    })
                    .catch(error => {
                        this.response.message = 'Υπάρχει πρόβλημα με τα δεδομένα που έδωσες'
                        this.response.status = false
                        this.response.errors = error.response.data.errors

                        this.loading = false
                    })
            },

            removeTag(index) {
                this.tags.splice(index, 1)
            }
        }
    }
</script>

<style scoped>
    .tag {
       cursor: pointer;
    }
</style>
