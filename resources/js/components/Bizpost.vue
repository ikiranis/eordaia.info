<template>
    <div>
        <div class="mb-3">
            <label for="email">email</label>
            <input type="email" max="255" v-model="business.email"
                   class="form-control col-6 px-2"
                   id="email" name="email">
        </div>

        <input type="button" class="btn btn-success" @click="checkBusiness" value="Έλεγχος">

        <div v-if="showBusiness" class="business">
            <div class="mb-3">
                <label for="name">Όνομα επιχείρησης</label>
                <input type="text" max="255" v-model="business.name"
                       class="form-control col-6 px-2"
                       id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="address">Διεύθυνση</label>
                <input type="text" max="255" v-model="business.address"
                       class="form-control col-6 px-2"
                       id="address" name="address">
            </div>

            <input type="button" class="btn btn-success" value="Καταχώρηση επιχείρησης"
                   @click="saveBusiness" :disabled="!canSaveBusiness">
        </div>

        <div v-if="showBizpost" class="post">
            <div class="mb-3">
                <label for="title">Τίτλος</label>
                <input type="text" max="255" v-model="bizpost.title"
                       class="form-control col-6 px-2"
                       id="title" name="title">
            </div>

            <div class="form-group">
                <label class="form-check-label" for="body">Κείμενο</label>
                <textarea v-model="bizpost.body"
                          class="form-control"
                          id="body" name="body" rows="15"></textarea>
            </div>

            <div class="mb-3">
                <label for="due_date">Ημερομηνία λήξης</label>
                <input type="date" v-model="bizpost.due_date"
                       class="form-control col-6 px-2"
                       id="due_date" name="due_date">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                business: {
                    name: '',
                    address: '',
                    email: 'rocean@error.gr'
                },

                bizpost: {
                    title: '',
                    body: '',
                    due_date: ''
                },

                showBusiness: false,
                showBizpost: false
            }
        },

        computed: {
            canSaveBusiness() {
                return this.business.name !== '' && this.business.address !== ''
            }
        },

        methods: {
            checkBusiness() {
                axios.get('api/checkBusiness/' + this.business.email)
                    .then(response => {
                        this.showBusiness = true

                        if (response.status === 204) {
                            console.log('Δεν υπάρχει εγγραφή με αυτό το email ')
                            return
                        }

                        this.business = response.data
                    })
                    .catch(error => {
                        console.log(error.response.data.message)
                    })
            },

            saveBusiness() {

                this.showBizpost = true;
            }
        }
    }
</script>
