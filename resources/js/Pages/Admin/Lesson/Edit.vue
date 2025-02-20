<template>
  <admin-layout>
    <template v-slot:head>
        <div class="w-full flex justify-between">
            <h1>Clase</h1>
            <Link :href="route('manager.courses.lessons.index', course.id)" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md   shadow">
                Regresar
            </Link>
        </div>
    </template>
    <template v-slot:content>

        <div class="grid grid-cols-1 sm:grid-cols-2 space-x-5 space-y-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-8">
                <lesson-form
                    :content="lesson"
                    action="patch"
                    :trainers="trainers"
                    :course="course"
                    :route-action="route('manager.courses.lessons.update', {course: course.id, lesson: lesson.id})"
                    :back-to="route('manager.courses.lessons.index', {id: course.id})"
                />
            </div>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg  p-8">
                <h1 class="mb-5">Material de la clase</h1>

                <form :action="route('manager.lessons.material.store', {'id': lesson.id})" class="dropzone" id="myDropzone"></form>

                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200 mt-12">
                    <template v-for="material in lesson.materials">
                        <li class="pl-3 pr-4 py-3 flex items-center justify-between ">
                            <div class="w-0 flex-1 flex items-center">
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/paper-clip" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-2 flex-1 w-0 truncate">
                                    {{ material.filename }}
                                </span>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <a :href="material.download_link" :download="material.filename" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    Descargar
                                </a>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
      <div class="w-full flex justify-center">

      </div>
    </template>
  </admin-layout>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout";
import LessonForm from "@/Pages/Shared/LessonForm";
import 'dropzone-vue/dist/dropzone-vue.common.css';
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

export default {
  components: {AdminLayout, LessonForm, Dropzone, Link},
  props: {
    backTo: {
      type: String,
    },
    course: {
      type: Object,
    },
    lesson: {
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
              hours_duration: '',
              minutes_duration: '',
              thumbnail_url: '',
              video_url: '',
              video_source: '',
              score: 0,
              is_active: 1,
              user_id: ''
          },
      }
  },
    mounted() {
        const self = this;
        const csrf = this.$page.props.csrf_token;
        const dz = new Dropzone("#myDropzone", {
            dictDefaultMessage: "Coloca aquí los materiales para esta clase",
            maxFilesize: 10,
            maxFiles: 10,
            parallelUploads: 2,
            uploadMultiple: false,
            createImageThumbnails: false,
            acceptedFiles: 'image/*, .pdf, .doc, .docx, .pptx, .xls, .xlsx',
            headers: {
                'x-csrf-token': this.$page.props.csrf_token,
            },
        });

        dz.on("sending", (file, xhr, formData) => {
            formData.append('_csrf_token', csrf);
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    self.lesson.materials.push(JSON.parse(this.response))
                }
            }
        });
        dz.on("complete", (file) => {
            setTimeout(() => {
                dz.removeFile(file);
            }, 1500);
        });
    }
}
</script>

<style scoped>
.dropzone {
    border: #b1b1b1 dashed;
}
</style>
