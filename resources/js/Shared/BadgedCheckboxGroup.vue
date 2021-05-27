<template>
		<slot></slot>
</template>

<script>
export default {
		provide() {
				return {
						sharedBadgeIndexes: this.sharedBadgeIndexes
				}
		},
		data() {
				return {
						sharedBadgeIndexes: {
								availableIndexes: [],
								selectedIndexes: []
						}
				}
		},
}
</script>

