<template>
  <page-layout>
    <template v-slot:section>
      <h1>Wellness Center / Áreas</h1>
    </template>
    <template v-slot:content>
      <div class="px-0 md:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          <Link :href="route('webapp.wellness.disciplines')" v-for="n in 3">
            <div class="rounded shadow relative z-0 transform hover:scale-105 transition duration-200">
              <img src="https://dam.smashmexico.com.mx/wp-content/uploads/2020/09/The-Flash-sus-posibles-cameos-nos-encantaria-verlos-en-la-pantalla-grande.jpg" alt="" class="rounded">
              <h1 class="absolute  top-1/2 left-1/2 font-extrabold text-white uppercase text-lg md:text-6xl transform own-translate-2">Cuerpo</h1>
            </div>
          </Link>
        </div>
      </div>
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
      PageLayout,
      Link,
  }
}
</script>

<style scoped>

</style>
