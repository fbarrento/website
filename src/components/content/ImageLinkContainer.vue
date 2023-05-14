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

const getImageUrl = () => {
    try {
        const src = props.src;
        return new URL (`../../assets/img/${src}`, import.meta.url);
    } catch(err) {
        console.log(err);
        return null
    }
}

</script>

<template>
    <a :href="getImageUrl()" :target="target" class="flex flex-col items-center text-sm no-underline font-normal mb-16">
        <img :src="getImageUrl()" :alt="alt" class="mb-2" />
        <span v-if="legend" class="text-gray-500 -mt-2">
            {{ legend }}
        </span>
    </a>
</template>