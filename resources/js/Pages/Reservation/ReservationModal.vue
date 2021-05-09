<template>
		<ModalBase :open="open"
		           class="p-5"
		           wrapper-class="w-2/5 inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:p-6">
				<div class="pb-2 flex justify-between items-center">
						<div class="flex items-center flex-wrap max-w-[50vw]">
								<h3 class="text-lg leading-6 font-medium text-gray-900">
										Reservation
								</h3>
						</div>
						<button @click="closeModal">
								<XIcon class="block h-6 w-6"/>
						</button>
				</div>
				<form @submit.prevent="register">
						<div class="shadow overflow-hidden sm:rounded-md">
								<div class="px-4 py-5 bg-gray-100 sm:p-6">
										<div class="grid grid-cols-6 gap-6">
												<div class="col-span-6 sm:col-span-3">
														<text-input v-model="form.title" :error="form.errors.title"
														            label="Title"/>
												</div>
												<div class="col-span-6 sm:col-span-3"/>

												<div class="col-span-6 sm:col-span-3">
														<select-input v-model="form.category_id" :error="form.errors.category_id"
														              label="Category">
																<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
														</select-input>
												</div>
												<div class="col-span-6 sm:col-span-3">
														<select-input v-model="form.room_type" :error="form.errors.room_type"
														              label="Room type">
																<option value="terrace">Terrace</option>
																<option value="common">Common place</option>
														</select-input>
												</div>

												<div class="col-span-6 sm:col-span-3">
														<text-input v-model="form.reservation_date" :error="form.errors.reservation_date"
														            label="Date"/>
												</div>
												<div class="col-span-6 sm:col-span-3"/>

												<div class="col-span-6 sm:col-span-3">
														<text-input v-model="form.reservation_start_time"
														            :error="form.errors.reservation_start_time" label="Start time"/>
												</div>

												<div class="col-span-6 sm:col-span-3">
														<text-input v-model="form.reservation_end_time" :error="form.errors.reservation_end_time"
														            label="End time"/>
												</div>
										</div>
								</div>
								<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
										<button type="submit"
										        @click="createReservation"
										        :disabled="form.processing"
										        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
												Create
										</button>
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

export default {
		props: {
				open: Boolean,
				categories: Object,
		},
		components: {
				ModalBase,
				XIcon,
				TextInput,
				TextareaInput,
				SelectInput
		},
		data() {
				return {
						form: this.$inertia.form({
								title: null,
								category_id: null,
								room_type: null,
								reservation_date: null,
								reservation_start_time: null,
								reservation_end_time: null,
						}),

				}
		},
		emits: ['close-modal'],

		methods: {
				createReservation() {
						this.form.post('/reservation')
				},
				closeModal() {
						this.$emit('close-modal');
				}
		},
}
</script>