<template>
		<div>
				<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest mb-2" style="padding-top: 1rem;">
						<h1 class="mb-2 font-bold text-3xl">All Reservations Page</h1>

						<div class="bg-white rounded-md shadow overflow-x-auto">
								<table class="w-full whitespace-nowrap">
										<tr class="text-left font-bold">
												<th class="px-6 pt-6 pb-4">Reservation title</th>
												<th class="px-6 pt-6 pb-4">Owner</th>
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

												<td class="border-t px-6 py-4 " v-html="reservation.user_info">
												</td>

												<td class="border-t px-6 py-4 ">
														{{ reservation.category.name }}
												</td>

												<td class="border-t px-6 py-4 ">
														{{ reservation.room_type }}
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
														<button @click="changeStatusClicked(reservation)"
														        class="focus:outline-none bg-yellow-300 hover:bg-yellow-700 text-white py-1 px-2 text-sm rounded">
																Change Status
														</button>

												</td>
										</tr>
										<tr v-if="reservations.data.length === 0">
												<td class="border-t px-6 py-4 text-center" colspan="7">No reservations found</td>
										</tr>
								</table>
								<!--								<pagination class="m-2 pb-4"/>-->
								<pagination-left v-if="reservations.data.length !== 0" class="m-2 pb-4"
								                 :reservations="reservations"/>
						</div>
				</div>
				<reservation-modal
						@close-modal="closeModal()"
						:open="isModalOpen"
						:reservation="editingReservation"
						:categories="reservationCategories"
						v-if="isModalOpen"
				>
				</reservation-modal>
		</div>
</template>

<script>
import Layout from '@/Layouts/Layout';
import {ShieldCheckIcon} from '@heroicons/vue/outline'
import ReservationModal from "./AdminReservationModal";
import Pagination from "@/Shared/Pagination";
import PaginationLeft from "@/Shared/PaginationLeft";

export default {
		name: 'Reservation',
		layout: Layout,
		props: {
				reservations: Object,
				reservationCategories: Object
		},
		computed:
				{},
		components: {
				PaginationLeft,
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
				changeStatusClicked(reservation) {
						this.editingReservation = reservation;
						this.isModalOpen = true;
				},
		},
}
</script>

<style scoped>

</style>