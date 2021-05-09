<template>
		<div class="max-w-2xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest " style="padding-top: 1rem;">
				<div class="sm:mx-4 lg:mx-8 sm:px-6 lg:px-8 ">
						<div class="md:col-span-2 ">
								<div class="px-4 sm:px-0">
										<h3 class="text-lg font-medium leading-6 text-gray-900">Login</h3>
								</div>
						</div>
						<div class="mt-5 md:mt-0 md:col-span-2">

								<form @submit.prevent="login">

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
																		<label class="mt-2 select-none flex items-center" for="remember">
																				<input id="remember" class="mr-1 rounded-md" type="checkbox"/>
																				<span class="text-sm">Remember Me</span>
																		</label>
																</div>
														</div>
												</div>
												<div class="px-4 py-3 bg-gray-50 text-center sm:px-6">
														<button type="submit"
														        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
																Login
														</button>
														<inertia-link href="/forgot-password"
														              class="inline-flex justify-center py-2 px-4 text-sm font-medium rounded-md text-indigo-500">
																Forgot password?
														</inertia-link>
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

export default {
		name: 'Login',
		components: {
				TextInput,
				TextareaInput
		},
		layout: Layout,

		data() {
				return {
						form: this.$inertia.form({
								email: null,
								password: null,
								remember: false,
						}),
				}
		},

		methods: {
				login() {
						this.form
								.transform(data => ({
										...data,
										remember: data.remember ? 'on' : '',
								}))
								.post('/login')
				},
		},
}
</script>

<style scoped>

</style>