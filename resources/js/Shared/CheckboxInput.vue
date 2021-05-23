<template>
		<div>
				<label class="flex w-full justify-center items-center text-md font-medium text-gray-700">
						<input
								class="px-2 mr-1 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-lg border-gray-300 rounded-md"
								type="checkbox"
								v-bind="$attrs"
								:checked="modelValue"
								@change="$emit('update:modelValue', $event.target.checked)"/>
						<span v-if='label' class="font-semibold text-black">{{ label }}</span>
				</label>
				<div v-if="error" class="text-red-500 text-sm">{{ error }}</div>
		</div>
</template>

<script>
export default {
		name: "CheckboxInput",
		inheritAttrs: false,
		props: {
				modelValue: Boolean | Number,
				label: String,
				error: String,
		},
		emits: ['update:modelValue'],
}
</script>
