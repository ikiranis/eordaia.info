<template>
	<div>
		<div class="col-lg col-12 row fixed-bottom mb-5">
			<loading class="mx-auto" :loading="loading"/>
		</div>

		<div class="input-group mb-3 no-gutters">
			<div class="input-group-prepend col-3">
				<label for="category" class="input-group-text w-100">Νέα κατηγορία</label>
			</div>
			<input type="text" v-model="category" class="form-control col-8 px-2"
				   id="category" maxlength="15" name="category">

			<span class="btn btn-success col-2" @click="insertCategory">Προσθήκη</span>

			<form-error v-if="response.errors.name"
						:error="response.errors.name[0]" />

			<input type="hidden" v-for="category in checkedCategories" name="categories[]" :value="category.id">
		</div>

		<div class="my-2 row">
			<div v-for="(category, index) in categories" class="mx-2">
				<input type="checkbox" id="categories" v-model="category.checked"
					   @click="checkCategory">

				<label for="categories" class="my-1">{{ category.name }}</label>
			</div>
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

				category: ''
			}
		},

		props: {
			categories: {
				required: true,
				type: Array
			}
		},

		computed: {
			checkedCategories() {
				return this.categories.filter(item => {
					return item.checked
				})
			}
		},

		methods: {
			insertCategory() {
				this.loading = true

				let myData = {
					name: this.category
				}

				axios.post('/api/category', myData)
					.then(response => {
						this.categories.push({
							id: response.data.id,
							name: response.data.name,
							checked: false
						})
						this.category = ''

						this.response.message = "Η κατηγορία καταχωρήθηκε"
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

			checkCategory() {
				console.log(this.checkedCategories)
			}
		}
	}
</script>
