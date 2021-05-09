<template>
		<div v-show="open"
		     class="fixed z-10 inset-0"
		     aria-labelledby="modal-title"
		     role="dialog"
		     aria-modal="true">
				<transition enter-active-class="ease-out duration-300"
				            enter-from-class="opacity-0"
				            enter-to-class="opacity-100"
				            leave-active-class="ease-in duration-200"
				            leave-from-class="opacity-100"
				            leave-to-class="opacity-0">
						<div class="flex items-end justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">
								<div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
								<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

								<transition enter-active-class="ease-out duration-300"
								            enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
								            enter-to-class="opacity-100 translate-y-0 sm:scale-100"
								            leave-active-class="ease-in duration-200"
								            leave-from-class="opacity-100 translate-y-0 sm:scale-100"
								            leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
								>
										<div v-show="open"
										     :class="wrapperClass ||'inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6'"
										>
												<slot></slot>
										</div>
								</transition>
						</div>
				</transition>
		</div>
</template>

<script>
export default {
		name: "ModalBase",
		props: {
				open: {required: true, type: Boolean},
				wrapperClass: String
		}
}
</script>