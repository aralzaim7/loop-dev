<template>
		<div class="max-w-5xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest " style="padding-top: 1rem;">
				<div class="max-w-7xl sm:mx-4 lg:mx-8 sm:px-6 lg:px-8  ">
						<div class="md:col-span-2 ">
								<div class="px-4 sm:px-0">
										<h3 class="text-lg font-medium leading-6 text-gray-900 my-2">Update Personal Information</h3>
								</div>
						</div>
						<div class="mt-5 md:mt-0 md:col-span-2">
								<form @submit.prevent="updateProfile">
										<div class="shadow overflow-hidden sm:rounded-md">
												<div class="px-4 py-5 bg-gray-100 sm:p-6">
														<div class="grid grid-cols-6 gap-6">
																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.first_name" :error="form.errors.first_name"
																		            label="First name" disabled/>
																</div>

																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.last_name" :error="form.errors.last_name"
																		            label="Last name" disabled/>
																</div>

																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.email" :error="form.errors.email" label="Email address"
																		            disabled/>
																</div>

																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.phone" :error="form.errors.phone" label="Phone number"/>
																</div>

																<div class="col-span-6">
																		<textarea-input v-model="form.address"
																		                :error="form.errors.address" label="Street address"/>
																</div>

																<div class="col-span-6 sm:col-span-3">
																		<select-input v-model="form.country" :error="form.errors.country"
																		              label="Country">
																				<option value="cy">Cyprus</option>
																				<option value="uk">United Kingdom</option>
																				<option value="tr">Turkey</option>
																		</select-input>

																</div>

																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.city" :error="form.errors.city" label="City"/>
																</div>
														</div>
												</div>
												<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
														<button type="submit"
														        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
																Save
														</button>
												</div>
										</div>
								</form>
						</div>
				</div>
		</div>
</template>
<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from "@/Shared/TextareaInput"
import SelectInput from "@/Shared/SelectInput";

export default {
		name: 'Profile',
		components: {
				TextInput,
				TextareaInput,
				SelectInput
		},
		layout: Layout,
		props: {user: Object},
		data() {
				return {
						form: this.$inertia.form(
								this.user
						),
				}
		},
		methods: {
				updateProfile() {
						this.form.put('/user/profile-information')
				},
				updatePassword() {
						//this.form.put('/user/profile-information')
				},
		},
}
</script>

<style scoped>

</style>