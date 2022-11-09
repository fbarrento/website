<script setup>


const authors = await queryContent('authors').find()

function getAuthor(path) {
         return authors.find(
            author => `/authors/${path}` === author._path
        )
    
    }

const episodes = await queryContent('series')
    .where({ type: "episode" })
    .sort({ episode: -1 })
    .find()





</script>
<template>
    <NuxtLayout name="default">
        <template #hero>
            <Hero />
        </template>
    <div>
        <div class="md:w-4/6">
            <h3 class="text-gray-500 font-medium pb-3">
                recent episodes
            </h3>
            <article
                v-for="episode in episodes"
                :key="episode._id"
                class="mb-8"
            >
                <div class="flex items-center pb-2" >
                    <img :src="getAuthor(episode.author).avatar" class="rounded-full w-7 bg-yellow-500" />
                    <div class="pl-2 text-sm">
                        <span class="font-semibold">
                            {{ getAuthor(episode.author).username }}
                        </span> in 
                        <span class="font-semibold">
                            Building Frandev.io Website
                        </span>
                    </div>
                </div>
                
                <h2 class="text-xl font-bold mb-1">
                    <NuxtLink :to="episode._path">
                        {{ episode.title }}
                    </NuxtLink>
                </h2>
                <p class="text-gray-500">{{ episode.description }}</p>
            </article>
        </div>
    </div>
</NuxtLayout>
        
    
    
</template>
