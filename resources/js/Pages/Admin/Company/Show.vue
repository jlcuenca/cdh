<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Empleados</h1>
            <div class="flex space-x-2">
                <Link :href="route('manager.companies.index')" class="px-4 py-2  flex items-center bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                    Regresar
                </Link>
                <Link :href="route('manager.companies.employees.create', {id: company.id})" class="rounded-md shadow bg-blue-500 text-white text-base hover:bg-blue-600 px-4 py-2 transition duration-100 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-plus" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 11h6m-3 -3v6"></path>
                    </svg>
                    <h2>Nuevo empleado</h2>
                </Link>
            </div>
        </template>
        <template v-slot:content>
          <table-component>
                <template v-slot:thead>
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="350">Correo electrónico</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="60">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="50">Acciones</th>
                  </tr>
                </template>
                <template v-slot:tbody>
                  <tr v-for="record in records.data">
                    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                        {{ record.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                      {{ record.email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                      {{ record.is_active ? 'Activo' : 'Inactivo'}}
                    </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
                        <Link :href="route('manager.companies.employees.edit', {company: company.id, employee: record.id})" class="text-indigo-600 hover:text-indigo-900">Editar</Link>
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
import TableComponent from "@/Components/TableComponent";

export default {
  components: {
    TableComponent,
    AdminLayout
  },
  props: {
    company: {
      type: Object,
    },
    records: {
      type: Object,
    },
    pagination: {
      type: String,
    }
  }
}
</script>
