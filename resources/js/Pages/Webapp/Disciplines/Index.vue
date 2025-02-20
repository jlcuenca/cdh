<template>
  <page-layout>
    <template v-slot:section>
      <h1>{{ title }}</h1>
    </template>
    <template v-slot:content>
      <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4">
        <Link v-for="(record, key) in records" :href="area !== null ? route('webapp.areas.disciplines.show', {area: area.id, discipline: record.id}) : route('webapp.disciplines.show', {id: record.id})">
          <div class="rounded shadow relative z-0 transform transition duration-200 hover:scale-105">
            <div class="flex justify-center items-center text-lg md:text-2xl uppercase text-maroon-600 bg-white rounded">
              <img class="rounded shadow" :src="hovered === key ? `/storage/${record.main_image}`: `/storage/${record.secondary_image}`" @mouseover="hovered = key" @mouseleave="hovered = null" />
            </div>
          </div>
        </Link>
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
