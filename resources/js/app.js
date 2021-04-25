import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init({
	// The delay after which the progress bar will
	// appear during navigation, in milliseconds.
	delay: 250,

	// The color of the progress bar.
	color: '#29d',

	// Whether to include the default NProgress styles.
	includeCSS: true,

	// Whether the NProgress spinner will be shown.
	showSpinner: false,
})
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const el = document.getElementById('app')

const app = createApp({
	render: () => h(App, {
		initialPage: JSON.parse(el.dataset.page),
		resolveComponent: name => import(`./Pages/${name}`).then(module => module.default)
	})
})

app.use(plugin)
	.mount(el);