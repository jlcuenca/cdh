<template>
    <admin-layout>

      <div class="pb-4 border-b border-gray-300 text-xl font-bold flex justify-between items-center">
        <h1>Publicación</h1>
        <Link :href="route('manager.posts.create')" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-2ea5b8b2=""><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-2ea5b8b2=""></path><line x1="12" y1="5" x2="12" y2="19" data-v-2ea5b8b2=""></line><line x1="5" y1="12" x2="19" y2="12" data-v-2ea5b8b2=""></line></svg>
        </Link>
      </div>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <post-form :form="form" />
        </div>
      </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/ManagerLayout";
import PostForm from "@/Pages/Admin/Post/Form";

export default {
  components: {
    AdminLayout,
    PostForm
  },
  data() {
    return {
      form: {
        title: '',
        excerpt: '',
        content:  '<p>Escribe aquí</p>',
        status: '',
        published: ''
      }
    }
  }
}
</script>
