<!-- This example requires Tailwind CSS v2.0+ -->
<template>
		<Disclosure as="nav" class="bg-gray-800">
				<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
						<div class="relative flex items-center justify-between h-16">
								<div class="absolute inset-y-0 left-0 flex items-center sm:hidden" v-if="$page.props.user">
										<!-- Mobile menu button-->
										<DisclosureButton
												@click="changeOpen"
												class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
												<span class="sr-only">Open main menu</span>
												<MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true"/>
												<XIcon v-else class="block h-6 w-6" aria-hidden="true"/>
										</DisclosureButton>
								</div>

								<div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
										<div class="flex-shrink-0 flex items-center">
												<inertia-link href="/">
														<img class="block lg:hidden h-8 w-auto"
														     src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
														     alt="Workflow"/>
												</inertia-link>
												<inertia-link href="/">
														<img class="hidden lg:block h-8 w-auto"
														     src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
														     alt="Workflow"/>
												</inertia-link>
										</div>
										<div class="hidden sm:block sm:ml-6">
												<div class="flex space-x-4" v-if="$page.props.user">
														<inertia-link v-for="item in navigation" :key="item.name"
														              :href="item.href"
														              :class="[checkCurrentPage(item.href) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']"
														              :aria-current="checkCurrentPage(item.href) ? 'page' : undefined">{{
																		item.name
																}}
														</inertia-link>
												</div>
										</div>
								</div>
								<div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
										<!-- Profile dropdown -->
										<Menu as="div" class="ml-3 relative">
												<div v-if="$page.props.user">
														<MenuButton
																class="bg-gray-800 flex items-center text-sm md:text-md rounded-full focus:outline-none">
																<span class="sr-only">Open user menu</span>
																<span class="flex items-center  text-gray-100 rounded-full">
																		{{ $page.props.user.first_name }}
																		<ChevronDownIcon class="block h-4 w-4" aria-hidden="true"/>
																</span>
														</MenuButton>
												</div>
												<div v-else class="flex">
														<inertia-link :href="`/register`"
														              :class="[active ? 'bg-gray-100' : '', 'block px-2 py-1 md:px-4 md:py-2 text-sm text-gray-100']">
																Register
														</inertia-link>
														<inertia-link :href="`/login`"
														              :class="[active ? 'bg-gray-100' : '', 'block px-2 py-1 md:px-4 md:py-2 text-sm text-gray-100']">
																Login
														</inertia-link>
												</div>
												<transition enter-active-class="transition ease-out duration-100"
												            enter-from-class="transform opacity-0 scale-95"
												            enter-to-class="transform opacity-100 scale-100"
												            leave-active-class="transition ease-in duration-75"
												            leave-from-class="transform opacity-100 scale-100"
												            leave-to-class="transform opacity-0 scale-95">
														<MenuItems
																class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
																<div v-if="!$page.props.user">
																		<MenuItem v-slot="{ active }">
																				<inertia-link :href="`/register`"
																				              :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
																						Register
																				</inertia-link>
																		</MenuItem>
																		<MenuItem v-slot="{ active }">
																				<inertia-link :href="`/login`"
																				              :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
																						Login
																				</inertia-link>
																		</MenuItem>
																</div>
																<div v-if="$page.props.user">
																		<MenuItem v-slot="{ active }">
																				<inertia-link :href="`/profile`"
																				              :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
																						Profile
																				</inertia-link>
																		</MenuItem>

																		<MenuItem v-slot="{ active }">
																				<inertia-link :href="`/logout`" method="post"
																				              :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
																						Logout
																				</inertia-link>
																		</MenuItem>
																</div>
														</MenuItems>
												</transition>
										</Menu>
								</div>
						</div>
				</div>
				<div v-show="open">
						<DisclosurePanel class="sm:hidden" v-if="$page.props.user" static>
								<div class="px-2 pt-2 pb-3 space-y-1">
										<inertia-link @click="changeOpen" v-for="item in navigation" :key="item.name" :href="item.href"
										              :class="[checkCurrentPage(item.href) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium']"
										              :aria-current="checkCurrentPage(item.href) ? 'page' : undefined">{{ item.name }}
										</inertia-link>

								</div>
						</DisclosurePanel>
				</div>

		</Disclosure>
		<slot/>
</template>

<script>
import {ref} from 'vue'
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {BellIcon, MenuIcon, XIcon, ChevronDownIcon} from '@heroicons/vue/outline'

export default {
		components: {
				Disclosure,
				DisclosureButton,
				DisclosurePanel,
				Menu,
				MenuButton,
				MenuItem,
				MenuItems,
				BellIcon,
				MenuIcon,
				XIcon,
				ChevronDownIcon
		},
		data() {
				return {
						open: false,
						navigation: [
								{name: 'Dashboard', href: '/dashboard'},
								{name: 'Reservation', href: '/reservation'},
						]
				}
		},
		methods: {
				changeOpen: function () {
						console.log(this.open);
						this.open = !this.open;
				},
				checkCurrentPage: function (currentPage) {

						return window.location.pathname.includes(currentPage);
				}
		}
}
</script>