<template>
  <Link :href="`${route('webapp.areas.index')}`" class="hover:text-maroon-600 transition duration-100">Wellness Center</Link>
  <Link :href="`${route('webapp.topics.index')}`" class="hover:text-maroon-600 transition duration-100">Capacitación</Link>
  <div class="flex space-x-2 items-center">
    <Link class="hover:text-maroon-600 transition duration-100">Live</Link>
    <div class="rounded-full h-3 w-3 flex relative">
      <span class="animate-ping absolute inline-flex w-full h-full rounded-full bg-maroon-400"></span>
      <span class="rounded-full h-3 w-3 bg-maroon-600 inline-flex relative"></span>
    </div>
  </div>
  <template v-if="$page.props.auth.user.is_company">
    <Link :href="`${route('webapp.company.index')}`" class="hover:text-maroon-600 transition duration-100">Empresa</Link>
    <Link :href="`${route('webapp.company-evaluation.index')}`" class="hover:text-maroon-600 transition duration-100">Diagnósticos</Link>
  </template>
</template>

<script>
export default {}
</script>
