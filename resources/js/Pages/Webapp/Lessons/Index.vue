<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Curso: {{ course.title }}
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <video-card-component v-for="record in records">
                    <template v-slot:video>
                        <Link :href="route('webapp.courses.lessons.show', {course: course.id, lesson: record.id})">
                            <img :src="`/storage/${record.thumbnail_url}`" class="hover:opacity-70 rounded-l-lg">
                        </Link>
                    </template>
                    <template v-slot:title>
                        <div v-if="record.progress.length > 0" class="flex justify-end">
                            <div class="flex inline">
                                <div :class="record.progress[0].completed ? 'bg-green-100' : 'bg-gray-100'" class="rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" :class="record.progress[0].completed ? 'text-green-600': 'text-gray-600'" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="12" cy="12" r="9"></circle>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg>
                                </div>
                                <span class="align-middle pt-1 ml-2 uppercase text-gray-500">
                                    {{ record.progress[0].completed ? 'Visto' : 'Cursando' }}
                                </span>
                            </div>
                        </div>
                        <div v-else class="flex justify-end">

                            Aún sin ver
                        </div>
                        <Link :href="route('webapp.courses.lessons.show', {course: course.id, lesson: record.id})" class="text-2xl font-bold hover:text-maroon-500">
                            {{ record.title }}
                        </Link>
                    </template>
                    <template v-slot:description>
                        <p class="text-gray-600 text-xl">
                            {{ record.excerpt }}
                        </p>
                    </template>
                    <template v-slot:duration>
                        <h3 class="font-bold">
                            {{ `${record.hours_duration} h ${record.minutes_duration} min` }}
                        </h3>
                    </template>
                </video-card-component>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import VideoCardComponent from "@/Components/VideoCardComponent";

export default {
  components: {VideoCardComponent, BreezeAuthenticatedLayout, Link},
  props: {
    course: {
      type: Object
    },
    records: {
      type: Object
    }
  }
}
</script>
