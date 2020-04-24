<template>
	<div v-if="loading">
		<img src="/graphics/loader.gif">
	</div>
</template>

<script>
	export default {
		props: {
			loading: Boolean
		}
	}
</script>
