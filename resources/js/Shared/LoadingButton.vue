<template>
		<button :disabled="loading" class="flex items-center">
				<div v-if="loading">
						<loading-icon />
				</div>
				<slot />
		</button>
</template>

<script>
import LoadingIcon from "@/Shared/LoadingIcon";
export default {
		components: {LoadingIcon},
		props: {
				loading: Boolean,
		},
}
</script>