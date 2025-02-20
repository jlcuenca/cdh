<template>
  <page-layout>
    <template v-slot:section>
      <h1>Wellness Center / Áreas</h1>
    </template>
    <template v-slot:content>
      <div class="px-0 md:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <Link v-for="(record, key) in records" :href="route('webapp.areas.disciplines.index', {id: record.id})">
            <div class="relative z-0 transform hover:scale-105 transition duration-200">
              <img class="rounded shadow" :src="hovered === key ? `/storage/${record.main_image}`: `/storage/${record.secondary_image}`" @mouseover="hovered = key" @mouseleave="hovered = null" />
            </div>
          </Link>
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
    }
  },
  data() {
    return {
      hovered: null,
    }
  }
}
</script>
