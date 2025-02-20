<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Curso</h1>
    </template>
    <template v-slot:content>
      <div class="w-full flex justify-center">
        <course-form
            :content="course"
            :redirect-to="category === 'wellness' ? route('manager.courses.index') : route('manager.trainings.index')"
            :route-action="route('manager.courses.update', {id: course.id})"
            action="patch"
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
  props: ['course'],
  data() {
    return {
      form: {
        title: '',
        area_id: '',
        discipline_id: '',
        name: '',
        excerpt: '',
        user_id: '',
        is_active: 1
      }
    }
  }
}
</script>
