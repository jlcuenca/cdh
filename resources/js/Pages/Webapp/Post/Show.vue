<template>
  <page-layout>
    <template v-slot:section>
      <h1>{{ post.title }}</h1>
    </template>
    <template v-slot:content>

      <img :src="post.image !== null ? `/storage/${post.image}` : '/images/none.png'" alt="" class="mx-auto">

      <div class="container mx-auto">
        <p class="text-lg md:text-xl py-4">{{ post.excerpt }}</p>
        <div v-html="post.content" class="p-2 sm:p-5 md:p-10 bg-white rounded-md shadow text-lg md:text-x"></div>
      </div>

    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";

export default {
  components: {
    PageLayout
  },
  props: {
    post: {
      type: Object
    },
  }
}
</script>
