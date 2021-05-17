<template>
<div>
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest mb-2 d-flex " style="padding-top: 1rem;">
				<div class="d-flex">
						<h1 class="mb-2 font-bold text-3xl">Reservation Users</h1>
				</div>
				<div class="mb-2 flex justify-end items-center">
						<button
								@click="isModalOpen = true"
								class="flex focus:outline-none bg-white hover:bg-gray-100 text-black border border-gray-400 text-sm font-bold py-2 px-4 rounded-md">
								Actions
								<ChevronDownIcon class="block h-4 w-4" aria-hidden="true"/>
						</button>
				</div>
				<div class="bg-white rounded-md shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
								<tr class="text-left font-bold">
										<th class="px-6 pt-6 pb-4">User</th>
										<th class="px-6 pt-6 pb-4">Information</th>
										<th class="px-6 pt-6 pb-4">E-mail</th>
										<th class="px-6 pt-6 pb-4">Phone</th>
										<th class="px-6 pt-6 pb-4">Created</th>
								</tr>
								<tr v-for="user in users.data" :key="user.id"
								    class="hover:bg-gray-100 focus-within:bg-gray-100">
										<td class="border-t px-6 py-4 ">
												{{ user.full_name }}
										</td>

										<td class="border-t px-6 py-4 " v-html="user.user_info">
										</td>

										<td class="border-t px-6 py-4 ">
												{{ user.email }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ user.phone }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ user.created_date }}
										</td>

								</tr>
								<tr v-if="users.data.length === 0">
										<td class="border-t px-6 py-4 text-center" colspan="7">No users found</td>
								</tr>
						</table>
						<!--								<pagination class="m-2 pb-4"/>-->
						<pagination-left v-if="users.data.length !== 0" class="m-2 pb-4"
						                 :users="users"/>
				</div>
		</div>
</div>
</template>

<script>
import Layout from "@/Layouts/Layout";
import FlashMessage from "@/Shared/FlashMessage";
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {BellIcon, ChevronDownIcon, MenuIcon, XIcon} from "@heroicons/vue/outline/esm";

export default {
		props: {
				users: {type: Object, required:true},
		},
		components: {
				ChevronDownIcon
		},
		name: "ReservationUsers",
		layout: Layout,


}
</script>

<style scoped>

</style>