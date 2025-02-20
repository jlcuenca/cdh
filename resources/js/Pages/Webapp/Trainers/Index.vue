<template>
    <page-layout>
        <template v-slot:section>
            <h1>{{ discipline.name }}</h1>
        </template>
        <template v-slot:content>
            <div class="px-0 md:px-20 space-y-8 uppercase text-lg md:text-2xl ">
                <h1 class="text-maroon-600 flex justify-center font-bold text-lg sm:text-3xl mt-6">
                    Coaches
                </h1>
                <div class="grid grid-cols-2 sm:md:grid-cols-3 md:grid-cols-4 gap-8">
                    <div v-for="(record, index) in records" class="flex justify-center">
                        <div class="space-y-4">
                            <div class="rounded-full w-32 md:w-64 h-32 md:h-64 transform transition duration-200 hover:scale-105">
                                <Link :href="route('webapp.areas.disciplines.coaches.show', {area: discipline.area_id, discipline:discipline.id, coach: record.id})">
                                  <div class="bg-gray-800 rounded-full w-32 md:w-64 h-32 md:h-64 absolute transition duration-200 opacity-80 hover:opacity-0">
                                  </div>
                                  <img :src="`/storage/${record.image}`" class="rounded-full object-cover h-full w-full ">
                                </Link>
                            </div>
                            <h1 class="font-bold text-center">
                              {{ record.name }}
                            </h1>
                        </div>
                    </div>
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
    discipline: {
      type: Object
    },
    records: {
      type: Object
    }
  }
}
</script>
