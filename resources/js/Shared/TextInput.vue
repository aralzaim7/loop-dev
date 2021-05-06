<template>
		<div>
				<label v-if='label' :for="id" class="block text-md font-medium text-gray-700">{{ label }}</label>
				<input v-bind="$attrs" :type="type"
				       class="px-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-lg border-gray-300 rounded-md"
				       :class="{ error: error }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
				<div v-if="error" class="text-red-500 text-sm">{{ error }}</div>
		</div>
</template>

<script>
export default {
		inheritAttrs: false,

		props: {
				id: {
						type: String,
				},
				type: {
						type: String,
						default: 'text',
				},
				modelValue: String,
				label: String,
				error: String,
		},
		methods: {},
}
</script>

<style scoped>

</style>