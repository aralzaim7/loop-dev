<template>
		<div
				class="inline-flex items-center px-2 py-5 rounded text-xs font-medium"
				:class="[isBooked ? 'cursor-not-allowed bg-red-200 text-red-800' : 'cursor-pointer bg-green-200 text-green-800', isSelected ? 'ring-1 ring-green-600' : '']"
				@click="clicked()"
		>
				<span>
				    {{ startTime }}
						{{ ' - ' }}
						{{ endTime }}
				</span>
		</div>
</template>

<script>
export default {
		props: {
				isBooked: {
						type: Boolean,
						required: true
				},
				startTime: {
						type: String,
						required: true
				},
				endTime: {
						type: String,
						required: true
				},
				isSelected: {
						type: Boolean,
						required: true
				},
		},

		emits: ['time-slot-clicked'],

		methods: {
				clicked() {
						if (this.isBooked) {
								return
						}
						this.$emit('time-slot-clicked', {
										isSelected: !this.isSelected,
										slot: `${this.startTime} - ${this.endTime}`
								}
						)
						;
				}
		},

}
</script>
