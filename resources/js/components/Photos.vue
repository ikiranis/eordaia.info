<template>
	<div>
		<div v-for="(photo, index) in photos" class="row my-3 border">

			<div class="form-group my-3 col-lg-6 col-12">
				<div class="custom-file">
					<input type="file" class="custom-file-input" name="uploadFile"
						   id="customFile"
						   accept='image/*'
						   @change="handleFile($event, index)">
					<label class="custom-file-label"
						   for="customFile">Φωτογραφία</label>
				</div>
			</div>

			<div class="input-group my-3 col-lg-6 col-12">
				<label class="sr-only"
					   for="photo_reference">Πηγή</label>
				<div class="input-group-prepend">
					<span class="input-group-text">Πηγή</span>
				</div>
				<input type="text" max="800" class="form-control" id="photo_reference"
					   name="photo_reference"
					   v-model="photo.reference">
			</div>
		</div>

		<button class="btn btn-success"
				type="button"
				@click="addPhoto">Προσθήκη φωτογραφίας</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				//
			}
		},

		props: {
			photos: {
				required: true,
				type: Array
			}
		},

		methods: {
			addPhoto() {
				this.photos.push({
					file: '',
					reference: ''
				})
			},
			insertPhoto() {

			},
			handleFile(event, index) {

				console.log(index)
				console.log(event.target.files[0]);
			}
		}
	}
</script>
