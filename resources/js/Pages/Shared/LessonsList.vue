<template>
    <div>
      <table-component>
        <template v-slot:thead>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duracion</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Material</th>
          <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </template>
        <template v-slot:tbody>
          <tr v-for="record in records.data">
            <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
              <Link :href="route('manager.courses.lessons.edit', {course: record.course_id, lesson: record.id})" class="text-blue-500 hover:text-maroon-600">
                {{ record.title }}
              </Link>
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-left">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                    {{ `${record.hours_duration}:${record.minutes_duration}` }}
                </div>
                <div class="ml-4">
                  <div class=" font-medium text-gray-900">

                  </div>
                  <div class=" text-gray-500">

                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1  inline-flex rounded-full">
                {{ record.is_active ? 'Activo' : 'Inactivo' }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">

                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                    <li class="pl-3 pr-4 py-3 flex items-center justify-between ">
                        <div class="w-0 flex-1 flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" x-description="Heroicon name: solid/paper-clip" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-2 flex-1 w-0 truncate">
                            {{ record.materials_count }} materiales
                          </span>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <a :href="route('manager.courses.lessons.edit', {course: record.course_id, lesson: record.id})" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Subir
                            </a>
                        </div>
                    </li>
                </ul>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
              <Link :href="route('manager.courses.lessons.edit', {course: record.course_id, lesson: record.id})" class="text-blue-500 hover:text-maroon-600">
                Editar
              </Link>
            </td>
          </tr>
        </template>
      </table-component>
      <div class="mt-5">
        <div v-html="pagination"></div>
      </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
      Link,
      AdminLayout,
      TableComponent
  },
  props: {
    records: {
      type: String
    },
    pagination: {
      type: String
    }
  }
}
</script>
