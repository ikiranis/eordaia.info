<template>
	<div>
		<div class="input-group mb-3 no-gutters">
			<div class="input-group-prepend col-3">
				<label for="category" class="input-group-text w-100">Νέα κατηγορία</label>
			</div>
			<input type="text" max="255" v-model="category" class="form-control col-8 px-2"
				   id="category" maxlength="15" name="category">

			<span class="btn btn-success col-2" @click="insertTag">Προσθήκη</span>

			<input type="hidden" v-for="category in checkedCategories" name="categories[]" :value="category.id">
		</div>

		<div class="my-2 row">
			<div v-for="(category, index) in categories" class="mx-2">
				<input type="checkbox" id="categories" v-model="category.checked"
					   @click="checkCategory">

				<label for="categories" class="my-1">{{ category.name }}</label>
			</div>
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
			insertTag() {
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
					})
					.catch(error => console.log(error.response))
			},

			checkCategory() {
				console.log(this.checkedCategories)
			}
		}
	}
</script>
