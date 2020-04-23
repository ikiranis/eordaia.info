<template>
	<div>
		<div v-for="(photo, index) in photos" class="my-3 px-1 py-1 border">
			<div class="row">
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
						   for="photoReference">Πηγή</label>
					<div class="input-group-prepend">
						<span class="input-group-text">Πηγή</span>
					</div>
					<input type="text" max="800" class="form-control" id="photoReference"
						   name="photoReference"
						   v-model="photo.reference">
				</div>
			</div>

			<div class="row">
				<label class="sr-only"
					   for="photoDescription">Περιγραφή</label>
				<textarea id="photoDescription" name="description" class="my-2 col-8 mx-auto"
						  v-model="photo.description" placeholder="Περιγραφή" />
			</div>

			<div v-if="photo.preview" class="row col-12">
				<img :src="photo.preview.src" class="mx-auto" width="350"/>
			</div>

			<div v-if="photo.url" class="row col-12">
				<img :src="photo.url" class="mx-auto" width="350"/>
			</div>

			<div class="row">
				<button class="btn btn-success col-6 my-2 mx-auto" type="button"
						@click="uploadPhoto(index)">Upload</button>
			</div>

		</div>

		<div class="row col-12">
			<button class="btn btn-success mx-auto"
					type="button"
					@click="addPhoto">Προσθήκη φωτογραφίας</button>
		</div>

		<input type="hidden" v-for="photo in uploadedPhotos" name="photos[]" :value="photo.id">
	</div>
</template>

<script>
	export default {
		data() {
			return {
				uploadedPhotos: []
			}
		},

		props: {
			photos: {
				required: true,
				type: Array
			}
		},

		created() {
			console.log(this.photos)
		},

		methods: {
			addPhoto() {
				this.photos.push({
					id: null,
					file: null,
					reference: '',
					description: '',
					preview: null,
					url: ''
				})
			},

			handleFile(event, index) {
				const preview = document.createElement("img")
				const file = event.target.files[0]
				const reader = new FileReader()

				reader.addEventListener("load", () => {
					// convert image file to base64 string
					preview.src = reader.result

					Object.assign(this.photos[index], {
						file: file,
						preview: preview
					})
				}, false)

				if (file) {
					reader.readAsDataURL(file)
				}
			},

			uploadPhoto(index) {
				let formData = new FormData()
				formData.append('file', this.photos[index].file)
				formData.append('reference', this.photos[index].reference)
				formData.append('description', this.photos[index].description)

				axios.post('/api/photo', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
					.then(response => {
						this.uploadedPhotos.push(response.data)
					})
					.catch(error => console.log(error.response))
			}
		}
	}
</script>
