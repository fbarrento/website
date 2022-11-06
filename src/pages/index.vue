<script setup>
const episodes = await queryContent('series')
  .where({ type: "episode" })
  .sort({ title: 1 })
  .find()

</script>
<template>
    <NuxtLayout name="default">
        <template #hero>
            <Hero />
        </template>
    <div>
        <h3 class="text-gray-500 font-medium pb-3">
            recent episodes
        </h3>
        <article
            v-for="episode in episodes"
            :key="episode._id"
            class="mb-6"
        >
            <h2 class="text-xl font-bold mb-1">
                <NuxtLink :to="episode._path">
                    {{ episode.title }}
                </NuxtLink>
            </h2>
            <p>{{ episode.description }}</p>
        </article>
    </div>
</NuxtLayout>
        
    
    
</template>
