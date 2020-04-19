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

			<div v-if="photo.preview" class="row col-12">
				<img :src="photo.preview.src" class="mx-auto" width="350"/>
			</div>

			<button class="btn btn-success"
					type="button"
					@click="uploadPhoto(index)">Upload</button>
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
					reference: '',
					preview: null
				})
			},

			handleFile(event, index) {
				const preview = document.createElement("img")
				let file = event.target.files[0]
				const reader = new FileReader();

				// TODO image displayed but only if you click on add new file button. Reactivity doesn't work
				reader.addEventListener("load", () => {
					// convert image file to base64 string
					preview.src = reader.result;

					this.photos[index] = {
						file: file,
						reference: this.photos[index].reference,
						preview: preview
					}

					console.log(this.photos[index])
				}, false);

				if (file) {
					reader.readAsDataURL(file);
				}
			},

			uploadPhoto(index) {
				let formData = new FormData()
				formData.append('file', this.photos[index].file)
				formData.append('reference', this.photos[index].reference)

				axios.post('/api/photo', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
					.then(response => {
						console.log(response)
					})
					.catch(error => console.log(error.response))
			}
		}
	}
</script>
