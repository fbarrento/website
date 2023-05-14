<script setup>

const route = useRoute()
const router = useRouter()

const { data: article } = await useAsyncData('article', () => {
    return queryContent('articles').where({slug: route.params.slug}).findOne()
})



</script>
<template>
  <NuxtLayout name="article">
    <article v-if="article" class="px-4">
      <div class="mb-8">
          <h1 class="text-2xl lg:text-5xl font-bold leading-none mt-8 lg:mt-16">
            {{ article.title }}
          </h1>
          <p class="my-4 text-lg lg:text-xl text-gray-500">{{ article.description }}</p>
          {{ article.readingTime }}
          <div class="pt-12 pb-8 overflow-hidden" v-if="article.coverImage">
            <img :src="article.coverImage" :alt="article.alt" class="w-full object-cover" />
          </div>
        </div>
        <div class="prose max-w-full lg:prose-lg">
         <ContentRenderer :value="article" />
        </div>
    </article>
  </NuxtLayout>
  </template>