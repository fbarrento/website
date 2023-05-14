<script setup>
import { ref } from 'vue';

const showMobileMenu = ref(false);
const route = useRoute();

watch(
  () => route.path,
  () => {
    showMobileMenu.value = false;
  }
);

</script>
<template>
    <div class="bg-white">
        <nav class="fixed z-10 top-0 w-full mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 bg-white/90" aria-label="Global">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold">
                    <NuxtLink to="/">
                        Frankdev.io
                    </NuxtLink>
                </h1>
            </div>
            <div class="flex sm:hidden">
            <button
                v-on:click="showMobileMenu=!showMobileMenu"
                type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            </div>
            <div class="hidden sm:block">
                <div class="flex space-x-6">
                    <NuxtLink to="/blog">
                        Blog
                    </NuxtLink>
                    <NuxtLink to="/series">
                        Series
                    </NuxtLink>
                    <NuxtLink to="/about-me">
                        About me
                    </NuxtLink>
                </div>
            </div>
        </nav>
        <!-- Mobile menu, show/hide based on open state -->
        <div class="sm:hidden" v-if="showMobileMenu">
            <div class="fixed inset-0 z-10"></div>
            <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold">
                        <NuxtLink to="/">
                            Frankdev.io
                        </NuxtLink>
                    </h1>
                    <button
                        v-on:click="showMobileMenu=!showMobileMenu"
                        class="rounded transition-all">
                        <span v-if="!showMobileMenu" class="transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                        </span>
                        <span v-else class="transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6L6 18M6 6l12 12"/></svg>
                        </span>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <div class="-mx-3">
                                <NuxtLink to="/blog" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                    Blog
                                </NuxtLink>
                                <NuxtLink to="/series" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                    Series
                                </NuxtLink>
                                <NuxtLink to="/about-me" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                    About
                                </NuxtLink>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>