<template>
		<div class="relative">
				<button
						@click="toggleDropdown()"
						class="flex justify-center items-center focus:outline-none bg-white hover:bg-gray-100 text-black border border-gray-400 text-sm font-bold py-2 px-4 rounded-md">
						{{ title }}
						<ChevronUpIcon v-if="isDropdownOpen" class="block h-4 w-4" aria-hidden="true"/>

						<ChevronDownIcon v-else class="block h-4 w-4" aria-hidden="true"/>
				</button>
				<div v-if="isDropdownOpen"
				     class="absolute bg-white w-full rounded-md shadow-md py-2">
						<button
								v-for="button in buttons"
								@click="$emit('action-clicked')"
								class="p-1 hover:bg-gray-200 outline-none focus:outline-none text-gray-600 flex justify-center items-center w-full">
								<MailIcon class="block h-4 w-4"/>
								{{ ' ' }}
								<span>{{ button.title }}</span>
						</button>
				</div>
		</div>
</template>

<script>

import {MailIcon, ChevronDownIcon, ChevronUpIcon} from '@heroicons/vue/outline'

export default {

		props: {
				title: {type: String, required: true},
				buttons: {type: Array, required: true},
		},
		data() {
				return {
						isDropdownOpen: false,
				}
		},
		methods: {
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

		components: {MailIcon, ChevronDownIcon, ChevronUpIcon},

		name: "DropdownButtons"
}
</script>

<style scoped>

</style>