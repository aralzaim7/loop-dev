<template>
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest" style="padding-top: 1rem;">
				<h1 class="mb-8 font-bold text-3xl">Reservations Page</h1>
				<div class="mb-6 flex justify-between items-center">
						<button
								@click="isModalOpen = true"
								class="focus:outline-none bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
								Create new reservation
						</button>
				</div>

				<div class="mb-6 flex justify-between items-center">

				</div>
				<div class="bg-white rounded-md shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
								<tr class="text-left font-bold">
										<th class="px-6 pt-6 pb-4">Reservation title</th>
										<th class="px-6 pt-6 pb-4">Category</th>
										<th class="px-6 pt-6 pb-4">Room type</th>
										<th class="px-6 pt-6 pb-4">Reservation time</th>
										<th class="px-6 pt-6 pb-4">User</th>
										<th class="px-6 pt-6 pb-4">Email</th>
										<th class="px-6 pt-6 pb-4">Phone</th>
										<th class="px-6 pt-6 pb-4">Created</th>
								</tr>
								<tr v-for="reservation in reservations" :key="reservation.id"
								    class="hover:bg-gray-100 focus-within:bg-gray-100">
										<td class="border-t px-6 py-4 ">
												{{ reservation.title }}
										</td>
										<td class="border-t px-6 py-4 ">
												{{ reservation.category.name }}
										</td>
										<td class="border-t px-6 py-4 ">
												{{ reservation.room_type }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ reservation.readable_reservation_time }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ reservation.user.full_name }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ reservation.user.email }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ reservation.user.phone }}
										</td>

										<td class="border-t px-6 py-4 ">
												{{ reservation.readable_creation_date }}
										</td>

								</tr>
								<tr v-if="reservations.length === 0">
										<td class="border-t px-6 py-4" colspan="4">No organizations found.</td>
								</tr>
						</table>
				</div>
		</div>
		<reservation-modal @close-modal="isModalOpen = false"
		                   :open="isModalOpen"
		                   :categories="reservation_categories"
		>
		</reservation-modal>
</template>

<script>
import Layout from '@/Layouts/Layout';
import ReservationModal from "./ReservationModal";

export default {
		name: 'Reservation',
		layout: Layout,
		props: {
				reservations: Object,
				reservation_categories: Object
		},
		computed:
				{

				},
		components: {
				ReservationModal
		},
		data() {
				return {
						isModalOpen: false,
				}
		},

		methods: {},
}
</script>

<style scoped>

</style>