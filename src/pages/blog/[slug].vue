<script setup>

const route = useRoute()
const router = useRouter()
//console.log(route.params, router, router.params)

const { data } = await useAsyncData('article', () => {
    
    console.log(route.path)
    return queryContent('').where({_path: route.path}).findOne()
})



</script>
<template>
    <article v-if="data" class="prose">
      <ContentDoc  :value="data" />
    </article>
  </template>