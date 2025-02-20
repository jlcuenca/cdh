<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('webapp.courses.lessons.index', {id: course.id})" class="hover:text-maroon-500">{{ course.title }}</Link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 bg-white rounded shadow">
                    <div class="space-y-0 col-span-1 md:col-span-2">
                        <div class="w-full h-full rounded">
                            <vimeo-video-player
                                :video-id="lesson.video_url"
                                :url="route('webapp.api.lesson.update', {id: lesson.id})"
                            />
                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-2 text-center md:text-left space-y-4  block md:flex flex-wrap content-between p-4">
                        <div class="flex w-full justify-between">
                            <div>
                                <div v-if="progress" class="flex inline">
                                    <div :class="progress.completed ? 'bg-green-100' : 'bg-gray-100'" class="rounded-full p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" :class="progress.completed ? 'text-green-600': 'text-gray-600'" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="12" r="9"></circle>
                                            <path d="M9 12l2 2l4 -4"></path>
                                        </svg>
                                    </div>
                                    <span class="align-middle pt-1 ml-2 uppercase text-gray-500">
                                      {{ progress.completed ? 'Visto' : 'Cursando' }}
                                    </span>
                                </div>
                            </div>
                            <button @click="like" :class="wasLiked ? 'bg-pink-500 text-white hover:bg-pink-400' : 'bg-gray-100 text-gray-500 hover:bg-pink-500 hover:text-white'" class="flex space-x-2 p-2 rounded transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                                </svg>
                                <span class="">
                                    Me gusta
                                  </span>
                            </button>
                        </div>
                        <div class="space-y-2 w-full block">
                            <h2 class="text-2xl uppercase font-bold">{{  lesson.title }}</h2>
                            <p class="text-gray-600 text-xl">{{ lesson.excerpt }}</p>
                        </div>
                        <div class="block w-full flex space-x-4 text-maroon-600  justify-center md:justify-start content-end">
                            <div class="flex w-full block space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <polyline points="12 7 12 12 15 15"></polyline>
                                </svg>
                                <h3 class="font-bold  truncate overflow-ellipsis overflow-hidden">
                                    {{ `${lesson.hours_duration} h ${lesson.minutes_duration} min` }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full mx-auto">
                    <div class="sm:grid grid-cols-4 gap-5">
                        <div class="col-start-1 col-end-2 my-2">
                            <template v-if="prev">
                                <Link :href="route('webapp.courses.lessons.show', {course: course.id, lesson: prev.id})">
                                    <h3 class="text-2xl mb-3 font-semibold inline-flex hover:text-maroon-500">
                                        <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.02698 11.9929L5.26242 16.2426L6.67902 14.8308L4.85766 13.0033L22.9731 13.0012L22.9728 11.0012L4.85309 11.0033L6.6886 9.17398L5.27677 7.75739L1.02698 11.9929Z" fill="currentColor" />
                                        </svg>
                                        Anterior
                                    </h3>
                                    <div class="dark:bg-gray-800 bg-white hover:shadow-xl rounded shadow-md">
                                        <img :src="`/storage/${prev.thumbnail_url}`" class="rounded hover:opacity-70">
                                    </div>
                                    <div class="mt-4 text-xl font-bold hover:text-maroon-500 uppercase">
                                        {{ prev.title }}
                                    </div>
                                </Link>
                            </template>
                        </div>
                        <div class="col-end-5 col-span-1 my-2">
                            <template v-if="next">
                                <Link :href="route('webapp.courses.lessons.show', {course: course.id, lesson: next.id})">
                                    <h3 class="text-2xl mb-3 font-semibold inline-flex hover:text-maroon-500">
                                        Siguiente
                                        <svg class="ml-2" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M23.0677 11.9929L18.818 7.75739L17.4061 9.17398L19.2415 11.0032L0.932469 11.0012L0.932251 13.0012L19.2369 13.0032L17.4155 14.8308L18.8321 16.2426L23.0677 11.9929Z" fill="currentColor" />
                                        </svg>
                                    </h3>
                                    <div class="dark:bg-gray-800 bg-white hover:shadow-xl rounded shadow-md text-right">
                                        <img :src="`/storage/${next.thumbnail_url}`" class="rounded hover:opacity-70">
                                    </div>
                                    <div class="mt-4 text-xl font-bold hover:text-maroon-500 uppercase">
                                        {{ next.title }}
                                    </div>
                                </Link>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2">
                        <div class="w-full">
                            <div>
                                <textarea v-model="form.comment" class="w-full p-2 border border-maroon-600 focus:border-2 focus:border-maroon-600 rounded text-lg focus:ring-maroon-600 transition duration-100" rows="3" placeholder="Escribe un comentario."></textarea>
                                <button v-if="form.comment !== ''"  @click="addComment" class="text-white bg-blue-500 hover:bg-blue-600 transition px-3 py-1 rounded">
                                    Comentar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-6">
                        <div class="w-full mt-4 ">
                            <div v-for="comment in comments.data" class="flex items-center space-x-2 mb-4">

                                <div class="flex flex-shrink-0 self-start">
                                    <div class="rounded-full h-12 w-12 bg-gray-300 text-gray-100 flex justify-center items-center content-center p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="400" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-3842e4c6=""><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-3842e4c6=""></path><circle cx="12" cy="7" r="4" data-v-3842e4c6=""></circle><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" data-v-3842e4c6=""></path></svg>
                                    </div>
                                </div>

                                <div class="flex items-center justify-center space-x-2">
                                    <div class="block ">
                                        <div class="bg-gray-50  border w-auto rounded-xl p-4">
                                            <div class="font-medium mb-1">
                                                {{ comment.user.name }}:
                                            </div>
                                            <div class="text-md">
                                                {{ comment.comment }}
                                            </div>
                                        </div>
                                        <div class="flex justify-start items-center text-md w-full">
                                            <div class="mt-2 text-gray-400 px-2 flex items-center justify-center space-x-1">
                                                <small>{{ comment.created_at_human }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="self-stretch flex justify-center items-center transform transition-opacity duration-200 opacity-0 translate -translate-y-2 hover:opacity-100">
                                    <a href="#" class="">
                                        <div class="text-xs cursor-pointer flex h-6 w-6 transform transition-colors duration-200 hover:bg-gray-100 rounded-full items-center justify-center">
                                            <svg class="w-4 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                                        </div>

                                    </a>
                                </div>

                            </div>
                        </div>

                        <div v-html="pagination">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Link, Head } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import VimeoVideoPlayer from "@/Components/VimeoVideoPlayer";

export default {
  components: {
      BreezeAuthenticatedLayout,
      VimeoVideoPlayer,
      Link,
      Head
  },
  props: {
    course: {
      type: Object
    },
    lesson: {
      type: Object
    },
    trainer: {
      type: Object
    },
    prev: {
      type: Object
    },
    next: {
      type: Object
    },
    liked: {
      type: Boolean,
      default: false
    },
    progress: {
      type: Object,
      default: null
    },
    comments: {
      type: Object,
      default: null
    },
    pagination: {
      type: String,
    },
  },
  data() {
    return {
      wasLiked: false,
      form: {
        comment: ''
      }
    }
  },
  methods: {
    addComment() {
      axios.post(route('webapp.lessons.comment.store', {lesson: this.lesson.id}), {
        comment: this.form.comment
      }).then(({ data }) => {
        this.form.comment = '';
        location.reload();
      });
    },
    like() {
      this.wasLiked = !this.wasLiked;
      axios.post(route('webapp.api.lesson.like', {id:this.lesson.id}), {
        liked: this.wasLiked
      }).then(({data}) => {

      }).catch(() => {

      })
    }
  },
  created() {
    this.wasLiked = this.liked;
  }
}
</script>
