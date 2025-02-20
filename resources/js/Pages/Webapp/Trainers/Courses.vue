<template>
  <page-layout>
    <template v-slot:section>
      <h1>Wellness Center / Cursos</h1>
    </template>
    <template v-slot:content>
      <div class="md:flex no-wrap md:-mx-2 ">
        <div class="w-full md:w-3/12 md:mx-2">
          <div class="bg-white p-3 border-t-4 border-maroon-500 rounded">
            <div class="image overflow-hidden">
              <img class="h-auto w-full mx-auto rounded" :src="`/storage/${trainer.data.image}`" alt="">
            </div>
            <h1 class="text-gray-900 font-bold text-2xl leading-8 py-4 px-2">
              {{ trainer.data.name }}
            </h1>
            <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3  divide-y rounded shadow-sm">
              <li class="flex items-center py-3">
                <span>Estado</span>
                <span class="ml-auto"><span class="bg-green-500 py-1 px-2 rounded text-white ">Activo</span></span>
              </li>
              <li class="flex items-center py-3">
                <span>Desde</span>
                <span class="ml-auto">{{ trainer.data.created_at }}</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="w-full md:w-9/12 md:mx-2">
          <section class="grid grid-cols-1 gap-y-2">
            <article v-for="record in records" class="border w-full mx-auto border-gray-200 rounded-lg bg-white px-6 py-4">
              <div class="">
                <h2 class="text-2xl font-bold mb-2 leading-7">
                  {{ record.title }}
                </h2>
                <div class="mb-1 leading-6">
                  {{ record.excerpt }}
                </div>

                <div class="flex justify-between items-center">
                  <div class="flex grid grid-cols-2 gap-x-2">
                    <div class="py-1 pl-1 pr-2 text-gray-600  rounded bg-gray-100 text-blue-500">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm inline w-5 h-5 -mt-1"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="13" r="7"></circle>
                        <polyline points="12 10 12 13 14 13"></polyline>
                        <line x1="7" y1="4" x2="4.25" y2="6"></line>
                        <line x1="17" y1="4" x2="19.75" y2="6"></line>
                      </svg>
                      {{ record.hours_minutes }}
                    </div>
                    <div  class="py-1 pl-1 pr-2 text-gray-600  rounded bg-gray-100 text-pink-500">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart inline w-4 h-4 -mt-1"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                      </svg>
                      <span class="hidden md:inline ml-1 pt-1">{{ record.likes_count }} Me gusta</span>
                    </div>
                  </div>

                  <div class="flex items-center">
                    <Link :href="route('webapp.courses.lessons.index', {id: record.id})" :class="record.progress_count === 0 ? 'bg-blue-500 text-white border-blue-600 hover:bg-blue-600' : 'bg-maroon-500 text-white border-maroon-600 hover:bg-maroon-600' " class="rounded  px-3 py-2 font-bold text-current shadow border ">
                       {{ record.progress_count === 0 ? 'Ver curso' : 'Seguir aprendiendo' }}
                    </Link>
                  </div>
                </div>

                <div class="block w-full" v-if="record.lessons_completed_count > 0">
                  <div class="mt-4 bg-gray-200 rounded-full">
                    <div :class="record.lessons_completed_count > 0 ? `w-${Math.round(record.lessons_completed_count * 12 / record.lessons_count)}/12 bg-green-500` : 'w-1/12'" class="py-0 rounded-full">
                      <div class="-mt-2 text-white  inline-block bg-green-500 px-2 rounded-full">
                        {{ `${record.lessons_completed_count} / ${record.lessons_count}` }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          </section>
        </div>
      </div>
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";

export default {
  components: {PageLayout},
  props: {
    records: {
      type: Object
    },
    trainer: {
      type: Object
    },
    area: {
      type: Object
    },
    discipline: {
      type: Object
    }
  },
  data() {
    return {
      'o': 'w-1/12 w-2/12 w-3/12 w-4/12 w-5/12 w-6/12 w-7/12 w-8/12 w-9/12 w-10/12 w-11/12 w-12/12'
    }
  }
}
</script>
