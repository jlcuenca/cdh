<template>
    <admin-layout>
      <template v-slot:main-content>
        <div class="px-10 py-5 space-y-4 transition duration-400 anim transform text-2xl font-bold">
          Curso: {{ course.title }}
        </div>
      </template>
        <template v-slot:head>
          <h1 class="text-lg">Lecciones</h1>
          <div class="flex space-x-2">

            <Link :href="route('manager.courses.index')" class="px-4 py-2  flex items-center bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
              Regresar
            </Link>

            <Link :href="route('manager.courses.lessons.create', {id:course.id})" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </Link>
          </div>
        </template>
        <template v-slot:content>
            <lessons-list
                :records="records"
                :pagination="pagination"
            />
        </template>
    </admin-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";
import LessonsList from "@/Pages/Shared/LessonsList";

export default {
  components: {
    AdminLayout,
    TableComponent,
    LessonsList,
      Link,
  },
  props: {
    course: {
      type: Object
    },
    records: {
      type: String
    },
    pagination: {
      type: String
    }
  }
}
</script>
