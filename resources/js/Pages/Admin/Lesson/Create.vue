<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Clase</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <lesson-form
                  :content="form"
                  :course="course"
                  :route-action="route('manager.courses.lessons.store', {id: course.id})"
                  :back-to="route('manager.courses.lessons.index', {id: course.id})"
              />
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import LessonForm from "@/Pages/Shared/LessonForm";

export default {
  components: {AdminLayout, LessonForm},
  props: {
    backTo: {
      type: String,
    },
    course: {
      type: Object,
    },
    trainers: {
      type: Object,
    },
  },
  data() {
    return {
      form: {
        title: '',
        excerpt: '',
        hours_duration: '00',
        minutes_duration: '00',
        thumbnail_url: '',
        video_url: '',
        video_source: '',
        score: 0,
        is_active: 1,
      },
    }
  },
}
</script>
