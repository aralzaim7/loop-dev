<template>
		<div class="relative">
				<button
						v-click-away="onClickAway"
						@click="toggleDropdown()"
						class="flex justify-center items-center focus:outline-none bg-white hover:bg-gray-100 text-black border border-gray-400 text-sm font-bold py-2 px-4 rounded-md">
						{{ title }}
						<ChevronUpIcon v-if="isDropdownOpen" class="block h-4 w-4" aria-hidden="true"/>

						<ChevronDownIcon v-else class="block h-4 w-4" aria-hidden="true"/>
				</button>
				<div v-if="isDropdownOpen"
				     class="absolute bg-white w-full rounded-md shadow-md py-2">
						<slot name="buttons">

						</slot>
				</div>
		</div>
</template>

<script>

import {ChevronDownIcon, ChevronUpIcon} from '@heroicons/vue/outline'

export default {

		props: {
				title: {type: String, required: true},
		},
		data() {
				return {
						isDropdownOpen: false,
				}
		},
		methods: {
				onClickAway(){
					this.closeDropDown()
				},
				toggleDropdown() {
						if (this.isDropdownOpen) {
								this.closeDropDown();
								return;
						}
						this.openDropDown()
				},
				openDropDown(){
						this.isDropdownOpen = true;
				},
				closeDropDown(){
						this.isDropdownOpen = false;
				},
		},
		emits: ['action-clicked'],

		components: {ChevronDownIcon, ChevronUpIcon},

		name: "DropdownButtons"
}
</script>

<style scoped>

</style>