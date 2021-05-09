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
														<loading-button :disabled="form.processing"
														                :loading="form.processing"
														                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
														                :class="form.processing ? 'bg-opacity-25 hover:none' : 'hover:bg-blue-700'"
														                type="submit">
																Save
														</loading-button>
												</div>
										</div>
								</form>
						</div>
				</div>
				<div class="max-w-7xl sm:mx-4 lg:mx-8 sm:px-6 lg:px-8  ">
						<div class="md:col-span-2 ">
								<div class="px-4 sm:px-0">
										<h3 class="text-lg font-medium leading-6 text-gray-900 my-2">Reset Password</h3>
								</div>
						</div>
						<div class="mt-5 md:mt-0 md:col-span-2">
								<form @submit.prevent="resetPassword">
										<div class="shadow overflow-hidden sm:rounded-md">
												<div class="px-4 py-5 bg-gray-100 sm:p-6">
														<div class="grid grid-cols-6 gap-6">
																<div class="col-span-3">
																		<text-input type="password" v-model="form2.current_password"
																		            :error="form2.errors.current_password"
																		            label="Old password"/>
																</div>
																<div class="col-span-3"/>

																<div class="col-span-3">
																		<text-input type="password" v-model="form2.password"
																		            :error="form2.errors.password"
																		            label="New password"/>
																</div>
																<div class="col-span-3"/>


																<div class="col-span-3">
																		<text-input type="password" v-model="form2.password_confirmation"
																		            :error="form2.errors.password_confirmation" label="Confirm new password"
																		/>
																</div>
																<div class="col-span-3"/>

														</div>
												</div>
												<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
														<loading-button :disabled="form2.processing"
														                :loading="form2.processing"
														                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
														                :class="form2.processing ? 'bg-opacity-25 hover:none' : 'hover:bg-blue-700'"
														                type="submit">
																Reset password
														</loading-button>
												</div>
										</div>
								</form>
						</div>
				</div>
		</div>
</template>
<script>
import Layout from '@/Layouts/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from "@/Shared/TextareaInput"
import SelectInput from "@/Shared/SelectInput";
import LoadingButton from "@/Shared/LoadingButton"


export default {
		name: 'Profile',
		components: {
				TextInput,
				TextareaInput,
				SelectInput,
				LoadingButton

		},
		layout: Layout,
		props: {user: Object},
		data() {
				return {
						form: this.$inertia.form(
								this.user
						),

						form2: this.$inertia.form({
								current_password: null,
								password: null,
								password_confirmation: null,
						}),
				}
		},
		methods: {
				updateProfile() {
						this.form.put('/user/profile-information')
				},
				resetPassword() {
							this.form2.put('/user/password',{
									errorBag: 'updatePassword',
							})
				},
		},
}
</script>

<style scoped>

</style>