<template>
		<ModalBase :open="open"
		           @close-modal="closeModal()"
		           class="p-5"
		           wrapper-class="w-4/5 md:w-3/5  inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:p-6">
				<div class="pb-2 flex justify-between items-center">
						<div class="flex items-center flex-wrap max-w-[50vw]">
								<h3 class="text-lg leading-6 font-medium text-gray-900">
										Reservation by {{ reservation.username }}
								</h3>
						</div>
						<button @click="closeModal()">
								<XIcon class="block h-6 w-6"/>
						</button>
				</div>
				<form @submit.prevent="editReservationStatus(reservation.id)">
						<div class="shadow overflow-visible sm:rounded-md">
								<div class="px-4 py-5 bg-gray-100 sm:p-6">
										<div class="grid grid-cols-6 gap-6">
												<div class="col-span-6 sm:col-span-2">
														<span class="text-sm font-bold">Reservation Title:</span>
												</div>
												<div class="col-span-6 sm:col-span-4">
														<span class="text-sm">{{ reservation.title }}</span>
												</div>

												<div class="col-span-6 sm:col-span-2">
														<span class="text-sm font-bold">Category:</span>
												</div>
												<div class="col-span-6 sm:col-span-4">
														<span class="text-sm">{{ reservation.category_name }}</span>
												</div>

												<div class="col-span-6 sm:col-span-2">
														<span class="text-sm font-bold">Room:</span>
												</div>
												<div class="col-span-6 sm:col-span-4">
														<span class="text-sm">{{ reservation.room_type_name }}</span>
												</div>

												<div class="col-span-6 sm:col-span-2">
														<span class="text-sm font-bold">Reservation Date/Time:</span>
												</div>
												<div class="col-span-6 sm:col-span-4">
														<span class="text-sm" v-html="reservation.readable_reservation_time"></span>
												</div>

												<div class="col-span-6 sm:col-span-2">
														<span class="text-sm font-bold">Status:</span>
												</div>
												<div class="col-span sm:col-span-4">
														<span class="text-sm" v-html="reservation.status"></span>
												</div>


												<div class="col-span-6 sm:col-span-3">
														<select-input v-model="form.status"
														              :error="form.errors.status"
														              label="Respond">
																<option value="approved">Approve</option>
																<option value="cancelled">Cancel</option>
														</select-input>
												</div>
										</div>
								</div>
								<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
										<loading-button :disabled="form.processing"
										                :loading="form.processing"
										                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-300  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-300"
										                :class="form.processing ? 'bg-opacity-25 hover:none' : 'hover:bg-yellow-500'"
										                type="submit">
												Change Status
										</loading-button>
								</div>
						</div>
				</form>
		</ModalBase>
</template>
<script>

import ModalBase from "@/Shared/ModalBase";
import {XIcon} from '@heroicons/vue/outline'
import TextInput from '@/Shared/TextInput'
import TextareaInput from "@/Shared/TextareaInput"
import SelectInput from "@/Shared/SelectInput";
import LoadingButton from "@/Shared/LoadingButton";
import DatepickerInput from "@/Shared/DatepickerInput";

export default {
		props: {
				open: {Boolean, required: true},
				categories: {Object, required: true},
				reservation: {Object, required: true},
		},
		components: {
				DatepickerInput,
				ModalBase,
				XIcon,
				TextInput,
				TextareaInput,
				SelectInput,
				LoadingButton,
		},
		data() {
				return {
						form: this.$inertia.form({
								status: undefined,
						}),
				}
		},
		emits: ['close-modal'],

		methods: {
				editReservationStatus(reservationId) {
						this.form.put(`/admin/reservations/${reservationId}`, {
								onSuccess: () => {
										this.closeModal();
								}
						})
				},
				closeModal() {
						this.$emit('close-modal');
				}
		},
}
</script>