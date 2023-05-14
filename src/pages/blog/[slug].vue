<script setup>

const route = useRoute()

const slug = ref(route.params.slug)

const { data, error } = await useAsyncData(`article-${slug.value}`, async () => {
    const article = queryContent('articles', route.params.slug).findOne()

    let surround = await queryContent()
      .only([
        "_path",
        "title",
        "description",
        "createdAt",
        "fileCreatedAt",
        "gitCreatedAt",
      ])
      .sort({ createdAt: -1 })
      .where({ _path: { $regex: "articles" } })
      .findSurround(`/articles/${slug.value}`);

      surround = surround.map((doc) => {
        if (doc?._path) doc._path = doc._path.replace("articles", "blog");
        return doc;
      });

      return { article: await article, surround: surround };

})

</script>
<template>
  <NuxtLayout name="article">
    <article v-if="data?.article" class="px-4">
      <div class="mb-8">
        <h1 class="text-3xl lg:text-5xl font-bold leading-none mt-8 lg:mt-16">
          {{ data?.article.title }}
        </h1>
        <p class="my-4 text-lg lg:text-xl text-gray-500">{{ data?.article.description }}</p>
        {{ data?.article.readingTime }}
        <div class="pt-12 pb-8 overflow-hidden" v-if="data?.article.coverImage">
          <img :src="data?.article.coverImage" :alt="data?.article.alt" class="w-full object-cover" />
        </div>
      </div>
      <div class="max-w-full prose lg:prose-lg">
        <ContentRenderer :value="data.article"></ContentRenderer>
      </div>
    </article>
    <div class="py-4 mb-16 px-6 flex justify-between border gap-4">
      <div class="text-left">
        <NuxtLink v-if="data?.surround[0]" :to="data?.surround[0]?._path" class="flex gap-2 font-semibold text-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l6 6m-6-6l6-6"/></svg>
          {{ data?.surround[0]?.title }}
        </NuxtLink>
      </div>
      <div class="text-right">
        <NuxtLink v-if="data?.surround[1]" :to="data?.surround[1]?._path" class="flex gap-2 font-semibold text-gray-700">
          {{ data?.surround[1]?.title }} 
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6 6l6-6m-6-6l6 6"/></svg>
        </NuxtLink>
      </div>
    </div>
  </NuxtLayout>
  </template>