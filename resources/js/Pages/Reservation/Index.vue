<template>
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest" style="padding-top: 1rem;">
				<h1 class="mb-8 font-bold text-3xl">Reservations Page</h1>
				<ul>
						<div v-for="reservation in reservations">
								<li>{{ reservation.title }}</li>
								<li>{{ reservation.category_id }}</li>
								<li>{{ reservation.room_type }}</li>
								<li>{{ reservation.reservation_date }}</li>
								<li>{{ reservation.reservation_start_time }}</li>
								<li>{{ reservation.reservation_end_time }}</li>
						</div>
				</ul>
		</div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
		name: 'Reservation',
		layout: Layout,
		props: {reservations: Object},
		data() {
				return {
						/*form: this.$inertia.form(
								this.user
						),*/
				}
		},
		methods: {
				update() {
						//this.form.post('/register')
				},
		},
}
</script>

<style scoped>

</style>