<template>
	<div>
		<div class="col-lg col-12 row fixed-bottom mb-5">
			<loading class="mx-auto" :loading="loading"/>
		</div>

		<div class="input-group mb-3 no-gutters">
			<div class="col-lg-4 col-12">
				<label class="sr-only" for="name">Τίτλος</label>
				<input type="text" v-model="video.name" class="form-control px-2"
					   id="name" maxlength="30" name="name" placeholder="Τίτλος">
			</div>

			<div class="col-lg-4 col-12">
				<label class="sr-only" for="url">Url</label>
				<input type="text" max="800" v-model="video.url" class="form-control px-2"
					   id="url" name="url" placeholder="Url">
			</div>

			<span class="btn btn-success col-lg-4 col-12" @click="insertVideo">Προσθήκη Video</span>

			<form-error v-if="response.errors.name"
						:error="response.errors.name[0]" />
			<form-error v-if="response.errors.url"
						:error="response.errors.url[0]" />

			<input type="hidden" v-for="video in videos" name="videos[]" :value="video.id">
		</div>

		<div class="my-2 row">
			<span v-for="(video, index) in videos"
				  class="my-1 mx-2 px-2 bg-primary text-light video"
				  @click="removeVideo(index)">{{ video.url }}</span>
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

				video: {
					name: '',
					url: ''
				}
			}
		},

		props: {
			videos: {
				required: true,
				type: Array
			},
		},

		methods: {
			insertVideo() {
				this.loading = false

				axios.post('/api/video', this.video)
					.then(response => {
						this.videos.push({
							id: response.data.id,
							name: response.data.name,
							url: response.data.url,
						})
						this.video = {}

						this.response.message = "To video καταχωρήθηκε"
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

			removeVideo(index) {
				this.videos.splice(index, 1)
			}
		}
	}
</script>

<style scoped>
	.video {
		cursor: pointer;
	}
</style>
