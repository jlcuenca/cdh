<template>
  <tr v-for="record in records">
    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
      <Link :href="route('manager.courses.lessons.index', {id: record.id})" class="text-blue-500 hover:text-blue-600">
        {{ record.title }}
      </Link>
    </td>
    <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-left">
        <Link :href="route('manager.courses.lessons.index', {id: record.id})" class="text-blue-500 hover:text-blue-600">
            {{ record.lessons_count }} Lecciones
        </Link>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-left font-medium">
        <Link :href="route('manager.courses.users.index', {id: record.id})" class="text-blue-500 hover:text-blue-600">
            {{ record.users_count }} Cursantes
        </Link>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1  inline-flex rounded-full">
        {{ record.is_active ? 'Activo' : 'Inactivo' }}
      </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
      <Link :href="route('manager.courses.edit', {id: record.id})" class="text-blue-500 hover:text-blue-600">
        Editar
      </Link>
    </td>
  </tr>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: { Link },
    props: ['records']
}
</script>
