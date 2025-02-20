<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Curso</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <course-form
                  :content="form"
                  :redirect-to="route('manager.courses.index')"
                  :route-action="route('manager.courses.store')"
                  action="post"
              />
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import CourseForm from "@/Pages/Admin/WellnessCenter/Course/CourseForm";

export default {
  components: {
    AdminLayout,
    CourseForm
  },
  props: ['areas', 'disciplines', 'trainers', 'category'],
  data() {
    return {
      form: {
        title: '',
        name: '',
        excerpt: '',
        is_active: 1
      }
    }
  }
}
</script>
