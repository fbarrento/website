<script setup>
</script>
<template>
    <div class="w-full fixed z-10 border-b border-gray-400 top-0 px-4 md:px-0 bg-white">
        <nav class="py-4 md:py-6 container mx-auto">
            <div class="flex justify-between">
                <h1 class="text-2xl font-semibold">
                    <NuxtLink to="/">
                        Frankdev.io
                    </NuxtLink>
                </h1>
                <div class="hidden sm:block">
                    <div class="flex space-x-6">
                        <NuxtLink to="/about-me">
                            About me
                        </NuxtLink>
                        <NuxtLink to="/series">
                            Series
                        </NuxtLink>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>