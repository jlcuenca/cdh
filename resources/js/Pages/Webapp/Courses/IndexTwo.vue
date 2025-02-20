<template>
  <page-layout>
    <template v-slot:section>
      <h1>{{ title }}</h1>
    </template>
    <template v-slot:content>
      <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div v-for="(record, key) in records" class="w-full min-h-screen">
          <div class="bg-white shadow rounded-lg overflow-hidden">
            <Link :href="route('webapp.courses.lessons.index', {id: record.id})">
            <div class="bg-cover bg-center h-56 p-4 hover:opacity-70" :style="record.image_url ? `background-image: url(/storage/${record.image_url})` : 'background-color: #4a4a4a;'">

              <div class="flex justify-end opacity-70">
                <span class="text-white mr-1 ">
                  {{ record.likes_count }}
                </span>
                <svg class="h-5 w-5 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                </svg>
              </div>

            </div>
            </Link>
            <div class="p-4">
              <p class="text-xl text-gray-900">
                {{ record.title }}
              </p>
            </div>
            <div class="flex justify-between p-4 border-t border-gray-300 text-gray-700 ">
              <div class="inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z"></path>
                  <rect x="3" y="6" width="12" height="12" rx="2"></rect>
                </svg>
                <p><span class="text-gray-900 font-bold ml-2">{{ record.lessons_count }}</span> Lecciones</p>
              </div>
              <div class="inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="12" cy="13" r="7"></circle>
                  <polyline points="12 10 12 13 14 13"></polyline>
                  <line x1="7" y1="4" x2="4.25" y2="6"></line>
                  <line x1="17" y1="4" x2="19.75" y2="6"></line>
                </svg>
                <p><span class="text-gray-900 font-bold">{{ record.hours_minutes_list.hh }} h {{ record.hours_minutes_list.mm }} m</span></p>
              </div>
            </div>
            <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">

              <div class="block  w-full">
                <template v-if="record.progress_count > 0">
                <div class="bg-gray-200 rounded-full">
                  <div :class="record.lessons_completed_count > 0 ? `w-${Math.round(record.lessons_completed_count * 12 / record.lessons_count)}/12 bg-green-500` : 'w-1/12'" class="py-0 rounded-full">
                    <div class=" text-white text-xs inline-block bg-maroon-700 px-2 rounded-full">
                    </div>
                  </div>
                </div>
                </template>
                <template v-else>
                  <div class="block  w-full"><div class="bg-gray-200 rounded-full"><div class="w-1/12 py-0 rounded-full"><div class=" text-white text-xs inline-block bg-maroon-700 px-2 rounded-full"></div></div></div></div>
                </template>
              </div>

              <div class="flex items-center pt-2">
                <Link :href="route('webapp.courses.lessons.index', {id: record.id})" :class="record.progress_count === 0 ? 'bg-blue-500 text-white border-blue-600 hover:bg-blue-600' : 'bg-maroon-500 text-white border-maroon-600 hover:bg-maroon-600'" class="w-full text-center rounded  px-3 py-2 font-bold text-current shadow border">
                  {{ record.progress_count === 0 ? 'Ver curso' : 'Seguir aprendiendo' }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";
import CardComponent from "@/Components/CardComponent";

export default {
  components: {
    PageLayout,
    CardComponent,
  },
  props: {
    title: {
      type: String
    },
    records: {
      type: Object
    },
    category: {
      type: String,
      default: 'wellness'
    },
    area: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      hovered: null,
    }
  }
}
</script>
