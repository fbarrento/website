<script setup lang="ts">
const articlesPath = ref("/articles");
const articleSlug = (path: string) => {
    return path.replace("articles", "blog");
}
</script>

<template>
    <NuxtLayout name="default">
        <main>
            <header>

            </header>
            <section class="">
                <div class="flex max-w-3xl mx-auto">
                    <ContentList
                        :path="articlesPath"
                        :query="{
                            only: [
                            'title',
                            'description',
                            'tags',
                            '_path',
                            'img',
                            'readingTime',
                            'author',
                            'createdAt',
                            'formattedCreatedAt',
                            'updatedAt',
                            'formattedUpdatedAt',
                            'gitCreatedAt',
                            'formattedGitCreatedAt',
                            'gitUpdatedAt',
                            'formattedGitUpdatedAt',
                            'fileCreatedAt',
                            'formattedFileCreatedAt',
                            'fileUpdatedAt',
                            'formattedFileUpdatedAt',
                            ],
                            $sensitivity: 'base',
                            sort: [
                            { createdAt: -1 },
                            // { gitCreatedAt: -1 },
                            // { fileCreatedAt: -1 },
                            // { gitUpdatedAt: -1 },
                            // { fileUpdatedAt: -1 },
                            // { updatedAt: -1 },
                            ],
                        }">
                        <!-- Default list slot -->
                            <template v-slot="{ list }">
                                <ul class="articles-list">
                                    <li
                                        v-for="article in list"
                                        :key="article._path"
                                        class="list-item"
                                    >
                                        <NuxtLink :to="article._path.replace('articles', 'blog')">
                                        <h2>{{ article.title }}</h2>
                                        <p class="article-description">
                                            {{ article.description }}
                                        </p>
                                        <ul class="flex gap-2 my-2 flex-wrap">
                                            <li class="rounded p-1 px-2 text-sm text-white bg-green-500" v-for="(tag, n) in article.tags" :key="n">
                                                <span class="block">{{ tag }}</span>
                                            </li>
                                        </ul>
                                        </NuxtLink>
                                    </li>
                                </ul>
                            </template>
                            <!-- Not found slot to display message when no content us is found -->
                            <template #not-found>
                                <p>No articles found.</p>
                            </template>
                    </ContentList>
                </div>
            </section>
        </main>
    </NuxtLayout>
</template>

<style scoped>
.articles-list {
    @apply space-y-6;
}

.list-item {
    @apply p-4
}

.list-item h2 {
    @apply text-3xl lg:text-4xl font-bold leading-none lg:leading-tight;
}

.article-description {
    @apply text-lg font-medium;
}
</style>