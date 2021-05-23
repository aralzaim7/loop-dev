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
																v-model="form.room_type_id"
																@update:model-value="roomTypeChanged()"
																:error="form.errors.room_type_id"
																label="Room type">
																<option v-for="roomType in roomTypes" :value="roomType.id">{{ roomType.name }}</option>
														</select-input>
												</div>

												<div class="col-span-6 sm:col-span-3">

														<datepicker-input v-model="form.reservation_date"
														                  @update:model-value="getNewAvailableSlots()"
														                  :error="form.errors.reservation_date"
														                  label="Date"/>

												</div>
												<div class="col-span-6 sm:col-span-3"/>

												<div class="col-span-6">
														<div v-if="loading"
														     class="flex justify-center items-center"
														>
																<loading-icon class="text-indigo-500 m-3"/>
														</div>
														<div v-else>
																<div v-if="available_reservation_slots?.length > 0"
																     class="grid grid-cols-4 gap-4">
																		<div v-for="available_slot in available_reservation_slots"
																		>

																				<badged-checkbox-input
																						:is-booked="available_slot.is_booked"
																						:start-time="available_slot.start_time"
																						:end-time="available_slot.end_time"
																						:is-selected="slotStatus(available_slot)"
																						@time-slot-clicked="slotSelected"
																				>
																				</badged-checkbox-input>
																		</div>
																</div>
																<div v-else-if="!form.room_type">
																		Select a room type and date to see available time slots.
																</div>
																<div v-else-if="available_reservation_slots?.length === 0">
																		Selected room is out of service on selected date.
																</div>
																<div v-if="form.errors.selected_time_slots"
																     class="text-red-500 text-sm">{{ form.errors.selected_time_slots }}
																</div>
														</div>
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
import CheckboxInput from "@/Shared/CheckboxInput";
import LoadingIcon from "@/Shared/LoadingIcon";
import BadgedCheckboxInput from "@/Shared/BadgedCheckboxInput";

export default {
		props: {
				open: {Boolean, required: true},
				categories: {Object, required: true},
				reservation: {Object, required: true},
				roomTypes: {Object, required: true},
		},
		components: {
				BadgedCheckboxInput,
				LoadingIcon,
				DatepickerInput,
				ModalBase,
				XIcon,
				TextInput,
				TextareaInput,
				SelectInput,
				LoadingButton,
				CheckboxInput
		},
		mounted() {
				this.form.reservation_date = this.reservation ? new Date(this.reservation.reservation_date) : new Date();
		},
		// watch: {
		// 		'form.room_type': {
		// 				handler(value) {
		// 						//do something
		// 						console.log(value);
		// 				}
		// 		},
		// },
		data() {
				return {
						form: this.$inertia.form({
								title: this.reservation?.title,
								category_id: this.reservation?.category_id,
								room_type_id: this.reservation?.room_type_id,
								reservation_date: this.reservation_date?.reservation_date,
								selected_time_slots: [],
						}),
						available_reservation_slots: null,
						loading: false,
				}
		},
		emits: ['close-modal'],

		methods: {
				slotStatus(timeSlot) {
						return this.form.selected_time_slots.includes(`${timeSlot.start_time} - ${timeSlot.end_time}`);
				},
				slotSelected(object) {
						if (!object.isSelected) {
								this.form.selected_time_slots = this.form.selected_time_slots.filter((item) => object.slot !== item)
								console.log(this.form.selected_time_slots);
								return
						}
						this.form.selected_time_slots.push(object.slot)
						console.log(this.form.selected_time_slots);
				},
				getNewAvailableSlots() {
						this.loading = true;
						axios
								.post('/reservation-helper', {
										room_type: this.form.room_type,
										date: this.formatDate(this.form.reservation_date)
								})
								.then(response => {
										this.loading = false
										this.available_reservation_slots = response.data
								})
								.catch(err => {
										console.log(err);
								});
				},
				roomTypeChanged() {
						this.form.reservation_date = new Date();
				},
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