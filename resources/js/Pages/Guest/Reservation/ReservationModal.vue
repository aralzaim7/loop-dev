<template>
		<ModalBase :open="open"
		           @close-modal="closeModal()"
		           class="p-5"
		           wrapper-class="w-2/5 inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:p-6">
				<div class="pb-2 flex justify-between items-center">
						<div class="flex items-center flex-wrap max-w-[50vw]">
								<h3 class="text-lg leading-6 font-medium text-gray-900">
										Reservation
								</h3>
						</div>
						<button @click="closeModal()">
								<XIcon class="block h-6 w-6"/>
						</button>
				</div>
				<form @submit.prevent="!reservation ? createReservation() : editReservation(reservation.id)">
						<div class="shadow overflow-visible sm:rounded-md">
								<div class="px-4 py-5 bg-gray-100 sm:p-6">
										<div class="grid grid-cols-6 gap-6">
												<div class="col-span-6 sm:col-span-3">
														<text-input v-model="form.title"
														            :error="form.errors.title"
														            label="Title"/>
												</div>
												<div class="col-span-6 sm:col-span-3"/>

												<div class="col-span-6 sm:col-span-3">
														<select-input v-model="form.category_id"
														              :error="form.errors.category_id"
														              label="Category">
																<option v-for="category in categories"
																        :value="category.id">{{ category.name }}
																</option>
														</select-input>
												</div>
												<div class="col-span-6 sm:col-span-3">
														<select-input
																v-model="form.room_type"
																:error="form.errors.room_type"
																label="Room type">
																<option v-for="roomType in roomTypes" :value="roomType.id">{{ roomType.name }}</option>
														</select-input>
												</div>

												<div class="col-span-6 sm:col-span-3">

														<datepicker-input v-model="form.reservation_date"
														                  :error="form.errors.reservation_date"
														                  label="Date"/>

												</div>
												<div class="col-span-6 sm:col-span-3"/>

												<div class="col-span-6 sm:col-span-3">
														<text-input type="time"
														            :min="startTime"
														            :max="endTime"
														            :step="timeInterval"
														            v-model="form.reservation_start_time"
														            :error="form.errors.reservation_start_time" label="Start time"/>
												</div>

												<div class="col-span-6 sm:col-span-3">
														<text-input type="time"
														            format="H:i"
														            :min="startTime+1"
														            :max="endTime+1"
														            :step="timeInterval"
														            v-model="form.reservation_end_time"
														            :error="form.errors.reservation_end_time"
														            label="End time"/>
												</div>
										</div>
								</div>
								<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
										<loading-button :disabled="form.processing"
										                :loading="form.processing"
										                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
										                :class="form.processing ? 'bg-opacity-25 hover:none' : 'hover:bg-blue-700'"
										                type="submit">
												{{ reservation ? 'Edit Reservation' : 'Create' }}
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
				roomTypes: {Object, required: true},
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
								title: this.reservation?.title,
								category_id: this.reservation?.category_id,
								room_type: this.reservation?.room_type,
								reservation_date: this.reservation ? new Date(this.reservation.reservation_date) : new Date(),
								reservation_start_time: this.reservation?.reservation_start_time,
								reservation_end_time: this.reservation?.reservation_end_time,
						}),
						startTime: "09:00",
						endTime: "17:00",
						timeInterval: "1800"

				}
		},
		emits: ['close-modal'],

		methods: {
				createReservation() {
						this.form
								.transform((data) => ({
										...data,
										reservation_date: this.formatDate(data.reservation_date),
								}))
								.post('/my-reservations', {
										onSuccess: () => {
												this.closeModal();
										}
								})
				},
				editReservation(reservationId) {
						this.form
								.transform((data) => ({
										...data,
										reservation_date: this.formatDate(data.reservation_date),
								}))
								.put(`/my-reservations/${reservationId}`, {
										onSuccess: () => {
												this.closeModal();
										}
								})

				},
				closeModal() {
						this.$emit('close-modal');
				},

				formatDate(date) {
						var d = new Date(date),
								month = '' + (d.getMonth() + 1),
								day = '' + d.getDate(),
								year = d.getFullYear();

						if (month.length < 2)
								month = '0' + month;
						if (day.length < 2)
								day = '0' + day;

						return [year, month, day].join('-');
				}
		},
}
</script>