<template>
    <div>
        <div class="autocomplete">
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
                            :error="response.errors.name[0]"/>

                <input type="hidden" v-for="tag in tags" name="tags[]" :value="tag.id">
            </div>

            <div class="autocomplete-items" v-if="tag.length > 0">
                <div v-for="tag in filteredTags" @click="chooseTag(tag)">
                    <strong>{{ tag }}</strong>
                </div>
            </div>
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

            tag: '',

            allTags: [],
        }
    },

    computed: {
        filteredTags() {
            return this.allTags.filter((tag) => {
                return tag.toUpperCase().includes(this.tag.toUpperCase())
            })
        }
    },

    props: {
        tags: {
            required: true,
            type: Array
        },
    },

    created() {
        this.getAllTags()
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

                    // this.response.message = "To tag καταχωρήθηκε"
                    // this.response.status = true

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
        },

        getAllTags() {
            axios.get('/api/tags')
                .then(response => {
                    this.allTags = response.data.map((item) => {
                        return item.name
                    })
                })
                .catch(error => {
                    this.response.message = 'Δεν μπόρεσε να γίνει η ανάγνωση των tags'
                    this.response.status = false
                    this.response.errors = error.response.data.errors

                    this.loading = false
                })
        },

        chooseTag(tag) {
            this.tag = tag
        }
    }
}
</script>

<style scoped>
.tag {
    cursor: pointer;
}

* {
    box-sizing: border-box;
}

body {
    font: 16px Arial;
}

.autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    display: block;
}

.autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
}

.autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
}

.autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: #e9e9e9;
}

.autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    background-color: DodgerBlue !important;
    color: #ffffff;
}
</style>
