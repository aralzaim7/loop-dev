<template>
		<div class="max-w-2xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest " style="padding-top: 1rem;">
				<div class="sm:mx-4 lg:mx-8 sm:px-6 lg:px-8 ">
						<div class="md:col-span-2 ">
								<div class="px-4 sm:px-0">
										<h3 class="text-lg font-medium leading-6 text-gray-900">Reset Password</h3>
								</div>
						</div>
						<div class="mt-5 md:mt-0 md:col-span-2">
								<form @submit.prevent="resetPassword">
										<div class="shadow overflow-hidden sm:rounded-md">
												<div class="px-4 py-5 bg-gray-100 sm:p-6">
														<div class="grid grid-cols-3 gap-6">
																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.email"
																		            :error="form.errors.email" label="Email" autofocus
																		            autocapitalize="off"/>
																</div>
																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.password"
																		            :error="form.errors.password"
																		            type="password"
																		            label="Password"/>
																</div>
																<div class="col-span-6 sm:col-span-3">
																		<text-input v-model="form.password_confirmation"
																		            :error="form.errors.password"
																		            type="password"
																		            label="Confirm password"/>

																</div>
														</div>
												</div>
												<input type="hidden" name="token" id="token"
												       v-model="form.token"
												/>

												<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
														<button type="submit"
														        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
																Change Password
														</button>
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

export default {
		props: {
				email: String,
				token: String,
		},

		name: 'ResetPassword',

		components: {
				TextInput,
		},
		layout: Layout,

		data() {
				return {
						form: this.$inertia.form({
								token: this.token,
								email: this.email,
								password: null,
								password_confirmation: null,
						}),
				}
		},

		methods: {
				resetPassword() {
						this.form.post('/reset-password')
				},
		},
}
</script>

<style scoped>

</style>