<script setup>

const props = defineProps({
    src: String,
    alt: String,
    legend: String,
    target:  {
        type: String,
        default: '_self'
    }
})



</script>

<template>
    <a 
        :href="src"
        :target="target"
        class="article-image-wrapper not-prose">
        <figure class="">
            <img :src="src" :alt="alt" class="mb-2" />
            <figcaption  v-if="legend" class="caption">
                {{ legend }}
            </figcaption>
        </figure>
    </a>
</template>

<style scoped>
.article-image-wrapper {
    @apply flex flex-col items-center text-sm no-underline font-normal mb-16;
}

img {
    @apply rounded-lg;
}

.caption {
    @apply text-gray-500 italic text-sm text-center;
}
</style>