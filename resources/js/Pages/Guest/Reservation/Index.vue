<template>
		<div>
				<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest mb-2" style="padding-top: 1rem;">
						<h1 class="mb-2 font-bold text-3xl">Reservations Page</h1>

						<div class="mb-2 flex justify-between items-center">
								<button
										@click="isModalOpen = true"
										class="focus:outline-none bg-green-500 hover:bg-green-700 text-white text-sm font-bold py-2 px-4 rounded-full">
										Create new reservation
								</button>
						</div>

						<div class="bg-white rounded-md shadow overflow-x-auto">
								<table class="w-full whitespace-nowrap">
										<tr class="text-left font-bold">
												<th class="px-6 pt-6 pb-4">Reservation title</th>
												<th class="px-6 pt-6 pb-4">Category</th>
												<th class="px-6 pt-6 pb-4">Room type</th>
												<th class="px-6 pt-6 pb-4">Reservation time</th>
												<th class="px-6 pt-6 pb-4">Status</th>
												<th class="px-6 pt-6 pb-4">Created</th>
												<th class="px-6 pt-6 pb-4">Process</th>
										</tr>
										<tr v-for="reservation in reservations.data" :key="reservation.id"
										    class="hover:bg-gray-100 focus-within:bg-gray-100">
												<td class="border-t px-6 py-4 ">
														{{ reservation.title }}
												</td>
												<td class="border-t px-6 py-4 ">
														{{ reservation.category.name }}
												</td>
												<td class="border-t px-6 py-4 ">
														{{ reservation.room_type_name }}
												</td>

												<td class="border-t px-6 py-4" v-html="reservation.readable_reservation_time">

												</td>

												<td class="border-t px-6 py-4 ">
														{{ reservation.status }}
												</td>

												<td class="border-t px-6 py-4 ">
														{{ reservation.readable_creation_date }}
												</td>

												<td class="border-t px-6 py-4 space-x-1">
														<div v-if="reservation.status === 'pending'"
														     class="grid grid-cols-2 gap-x-2">
																<button @click="editReservationClicked(reservation)"
																        class="col-span-1 focus:outline-none bg-yellow-300 hover:bg-yellow-700 text-white py-1 px-2 text-sm rounded">
																		Edit
																</button>
																<button @click="deleteReservationClicked(reservation.id)"
																        class="col-span-1 focus:outline-none bg-red-500 hover:bg-red-700 text-white py-1 px-2 text-sm rounded">
																		Delete
																</button>
														</div>
												</td>
										</tr>
										<tr v-if="reservations.data.length === 0">
												<td class="border-t px-6 py-4 text-center" colspan="7">No reservations found</td>
										</tr>
								</table>
								<pagination v-if="reservations.data.length !== 0" class="m-2 pb-4"
								                 :data="reservations"/>
						</div>
				</div>
				<reservation-modal
						@close-modal="closeModal()"
						:open="isModalOpen"
						:reservation="editingReservation"
						:categories="reservationCategories"
						:roomTypes="reservationRoomTypes"
						v-if="isModalOpen"
				>
				</reservation-modal>
		</div>
</template>

<script>
import Layout from '@/Layouts/Layout';
import {ShieldCheckIcon} from '@heroicons/vue/outline'
import ReservationModal from "./ReservationModal";
import Pagination from "@/Shared/PaginationLeft";

export default {
		name: 'Reservation',
		layout: Layout,
		props: {
				reservations: Object,
				reservationCategories: Object,
				reservationRoomTypes: Object,
		},
		computed:
				{},
		components: {
				Pagination,
				ReservationModal,
				ShieldCheckIcon
		},
		data() {
				return {
						isModalOpen: false,
						editingReservation: null
				}
		},

		methods: {
				closeModal() {
						this.isModalOpen = false;
						this.editingReservation = null;
				},
				editReservationClicked(reservation) {
						this.editingReservation = reservation;
						this.isModalOpen = true;
				},
				deleteReservationClicked(reservationId) {
						this.$inertia.delete(`/my-reservations/${reservationId}`, {
								onBefore: () => confirm('Are you sure you want to delete this reservation?'),
						})
				}
		},
}
</script>

<style scoped>

</style>