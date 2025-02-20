<template>
  <tr v-for="record in records">
    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
      <Link :href="route('manager.courses.lessons.index', {id: record.id})" class="text-blue-500 hover:text-maroon-600">
        {{ record.title }}
      </Link>
    </td>
    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
      {{ record.discipline.name }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-center">
      {{ record.lessons_count }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
      <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1  inline-flex rounded-full">
        {{ record.is_active ? 'Activo' : 'Inactivo' }}
      </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
      <Link :href="route('manager.courses.lessons.index', {id: record.id})" class="text-blue-500 hover:text-maroon-600">
        Ver
      </Link>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
      <Link :href="route('manager.courses.edit', {id: record.id})" class="text-blue-500 hover:text-maroon-600">
        Editar
      </Link>
    </td>
  </tr>
</template>

<script>
export default {
  props: ['records']
}
</script>
