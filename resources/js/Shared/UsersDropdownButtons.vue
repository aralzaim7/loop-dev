<template>
		<dropdown-buttons
				:title="title">
				<template v-slot:buttons>
						<button
								v-for="button in buttonList"
								@click="$emit(button.action)"
								class="p-1 hover:bg-gray-200 outline-none focus:outline-none text-gray-600 flex justify-center items-center w-full">
								<component :is="button?.icon" class="block h-4 w-4"/>

								<span class="px-1">{{ button.title }}</span>
						</button>
				</template>
		</dropdown-buttons>
</template>

<script>
import DropdownButtons from "@/Shared/DropdownButtons";
import {MailIcon, ChevronDownIcon, ChevronUpIcon} from '@heroicons/vue/outline'


export default {
		data() {
				return {
						title: 'Bulk Actions',
						buttonList: [
								{
										title: 'Send E-mail',
										icon: MailIcon,
										action: 'send-email',
								},
								{
										title: 'Other Button',
										action: 'other-action',
								},
								{
										title: 'Another Button',
										action: 'another-action',
								}
						],
				}
		},
		name: "UsersDropdownButtons",
		components: {DropdownButtons,MailIcon}
}
</script>

<style scoped>

</style>