<template>
		<div>
				<label v-if="label" class="form-label" :for="id">{{ label }}:</label>
				<select v-model="selected" v-bind="$attrs"
				        class="mt-1 block w-full py-1 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
				        :class="{ error: error }">
						<slot/>
				</select>
				<div v-if="error" class="form-error">{{ error }}</div>
		</div>
</template>

<script>
export default {
		inheritAttrs: false,
		props: {
				id: {
						type: String,
				},
				modelValue: [String, Number, Boolean],
				label: String,
				error: String,
		},
		data() {
				return {
						selected: this.modelValue,
				}
		},
		watch: {
				selected(selected) {
						this.$emit('update:modelValue', selected)
				},
		},
		methods: {},
}
</script>