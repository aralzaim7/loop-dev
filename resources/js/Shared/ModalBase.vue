<template>
		<div v-show="open"
		     class="fixed z-10 inset-0"
		     aria-labelledby="modal-title"
		     role="dialog"
		     aria-modal="true">
				<div class="flex items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">
						<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
						<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
						<div v-if="open"
						     v-click-away="onClickAway"
						     :class="wrapperClass ||'inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6'"
						>
							<slot></slot>
						</div>
				</div>
		</div>
</template>

<script>
export default {
		name: "ModalBase",
		props: {
				open: {required: true, type: Boolean},
				wrapperClass: String
		},
		methods: {
				onClickAway(event) {
						if (!open) return
						this.$emit('close-modal');
				},
		}
}
</script>