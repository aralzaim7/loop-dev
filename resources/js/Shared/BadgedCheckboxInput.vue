<template>
		<div
				class="inline-flex justify-center items-center px-2 py-5 rounded text-xs font-medium"
				:class="badgeClass"
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
				index: {
						type: Number
				},
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
				}
		},
		data() {
				return {
						selectedIndexes: [],
						isBookedClass: 'pointer-events-none cursor-not-allowed opacity-50 bg-gray-200 text-gray-800',
						isAvailableClass: 'cursor-pointer bg-yellow-200 text-yellow-600',
						isUnavailableClass: 'pointer-events-none cursor-not-allowed bg-red-200 text-red-800',
						isSelectedClass: 'cursor-pointer ring-1 ring-green-600 bg-green-200 text-green-800',
				}
		},
		inject: ['sharedBadgeIndexes'],

		computed: {
				badgeClass() {
						if (this.isBooked) return this.isBookedClass

						if (this.isSelected) return this.isSelectedClass

						if (this.isAvailable) return this.isAvailableClass

						return this.isUnavailableClass

				},
				isAvailable() {
						if (!this.sharedBadgeIndexes.availableIndexes.length) {
								return true
						}
						return this.sharedBadgeIndexes.availableIndexes.includes(this.index) || this.isSelected
				},
		},

		emits: ['time-slot-clicked', 'reset-slots'],

		methods: {
				clicked() {
						if (this.isBooked) return

						this.$emit('time-slot-clicked', {
								isSelected: !this.isSelected,
								slot: `${this.startTime} - ${this.endTime}`
						})

						let removedItem=null;
						if (!this.isSelected) {
								this.sharedBadgeIndexes.selectedIndexes.push(this.index)
						} else {
								this.sharedBadgeIndexes.selectedIndexes = this.sharedBadgeIndexes.selectedIndexes
										.filter((item) => {
												removedItem = item
												return item !== this.index
										})
						}

						this.setAvailableIndexes(removedItem)

				},

				setAvailableIndexes(removedItem) {

						let maxIndex = Math.max(...this.sharedBadgeIndexes.selectedIndexes);
						let minIndex = Math.min(...this.sharedBadgeIndexes.selectedIndexes);

						if (removedItem !== minIndex && removedItem !== maxIndex && removedItem) {
								this.sharedBadgeIndexes.availableIndexes = []
								this.sharedBadgeIndexes.selectedIndexes = []
								this.$emit('reset-slots')
						} else {
								this.sharedBadgeIndexes.availableIndexes = [minIndex - 1, maxIndex + 1]
						}
				}
		}
}

</script>
