<script setup>

const props = defineProps({
    src: String,
    alt: String,
    legend: String
})

const getImageURL = () => {
    try {
        return new URL(`../../assets/img/${props.src}`, import.meta.url);
    } catch(err) {
        console.log(err);
        return null
    }
}

</script>

<template>
    <div class="flex flex-col items-center text-sm no-underline font-normal mb-16">
        <img :src="getImageURL()" :alt="alt" class="mb-2" />
        <span v-if="legend" class="text-gray-500 -mt-2">
            {{ legend }}
        </span>
    </div>
</template>