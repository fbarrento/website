<template>
    <div>Hello from Series List</div>
    <div v-for="serie in data" :key="serie._id" >
        <h2>
            <NuxtLink :to="serie._path">
                {{ serie.title }}
            </NuxtLink>
        </h2>
        <p>{{ serie.description }}</p>
        <p v-if="serie.author">{{ serie.author.name }}</p>
    </div>
</template>
<script setup>

const { data } = await useAsyncData('content-section', () => {
    return queryContent('series')
        .where({ _dir: "series" })
        .sort({ title: -1 })
        .find()
})

</script>