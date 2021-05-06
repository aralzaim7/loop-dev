<template>
		<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 bg-gray-lightest" style="padding-top: 1rem;">
				<h1 class="mb-8 font-bold text-3xl">Welcome Page</h1>
				<p class="mb-8 leading-normal">Hey there! Welcome to Ping CRM, a demo app designed to help illustrate how <a
						class="text-indigo-500 underline hover:text-orange-600" href="https://inertiajs.com">Inertia.js</a> works.
				</p>
		</div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {

		metaInfo: {title: 'Welcome'},
		layout: Layout,
}
</script>