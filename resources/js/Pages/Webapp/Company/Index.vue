<template>
  <page-layout>
    <template v-slot:section>
      <h1>{{  company.name }}</h1>
    </template>

    <template v-slot:content>

      <div class="flex justify-between">
        <h1 class="text-xl font-bold">Empleados</h1>

        <div class="flex space-x-2" v-if="!limited">
          <Link :href="route('webapp.employees.create')" class="rounded-md shadow bg-blue-500 text-white text-base hover:bg-blue-600 px-4 py-2 transition duration-100 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
              <path d="M16 11h6m-3 -3v6"></path>
            </svg>
            <h2>Nuevo empleado</h2>
          </Link>
        </div>
      </div>

      <table-component>
        <template v-slot:thead>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="350">
              Correo electrónico
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="60">
              Cursos
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="60">
              Completados
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="60">
              Status
            </th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="50">
              Acciones
            </th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="50">
            </th>
          </tr>
        </template>
        <template v-slot:tbody>
          <tr v-for="record in employees.data">
            <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
              {{ record.name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
              {{ record.email }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-center text-gray-900">
              {{ record.courses_count }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-center text-gray-900">
              {{ record.courses_completed_count }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                  {{ record.is_active ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
              <Link :href="route('webapp.employees.edit', {employee: record.id})" class="text-indigo-600 hover:text-indigo-900">
                Editar
              </Link>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
              <Link :href="route('webapp.employees.show', {employee: record.id})" class="text-indigo-600 hover:text-indigo-900">
                Ver
              </Link>
            </td>
          </tr>
        </template>
      </table-component>

        <div class="mt-5">
          <div v-html="pagination"></div>
        </div>

    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";
import TableComponent from "@/Components/TableComponent";

export default {
  components: {
    PageLayout,
    TableComponent
  },
  props: {
    company: {
      type: Object
    },
    employees: {
      type: Object
    },
    pagination: {
      type: String
    },
    limited: {
      type: Boolean
    }
  }
}
</script>
