<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Cursantes</h1>
            <Link :href="route('manager.coaches.create')" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                     stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </Link>
        </template>
        <template v-slot:content>
          <table-component>
            <template v-slot:thead>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Información</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"  width="115">Cursos</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="115">Status</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="115">Acciones</th>
            </template>
            <template v-slot:tbody>
              <tr v-for="record in records.data">
                <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                  <div class="flex items-center">
                    <div class="">
                      <div class="font-medium text-gray-900">
                        <Link :href="route('manager.users.show', {id: record.id})" class="text-blue-500 hover:text-maroon-600">
                          {{ record.name }}
                        </Link>
                      </div>
                      <div class=" text-gray-500">
                        {{ record.email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <Link :href="route('manager.users.show', {id: record.id})">
                        <span :class="record.courses_count ? 'bg-blue-100 text-blue-800 hover:bg-pink-100' : 'bg-gray-100 text-gray-800'" class="px-2 py-1 inline-flex rounded-full">
                            {{ record.courses_count }}
                        </span>
                    </Link>
                </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1 inline-flex rounded-full">
                    {{ record.is_active ? 'Activo' : 'Inactivo' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
                  <Link :href="route('manager.coaches.edit', {id: record.id})" class="text-blue-500 hover:text-maroon-600">
                    Editar
                  </Link>
                </td>
              </tr>
            </template>
          </table-component>
          <div class="mt-5">
            <div v-html="pagination"></div>
          </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import { Link } from '@inertiajs/inertia-vue3';
import TableComponent from "@/Components/TableComponent";

export default {
  components: {
    TableComponent,
    AdminLayout,
      Link
  },
  props: {
    records: {
      type: Object,
    },
    pagination: {
      type: String,
    }
  }
}
</script>
