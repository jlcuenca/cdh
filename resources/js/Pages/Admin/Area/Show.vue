<template>
    <admin-layout>
      <template v-slot:main-content>
        <div class="px-10 py-6">
          <h1 class="text-3xl font-bold">Área: {{ area.name }}</h1>
        </div>
      </template>

        <template v-slot:head>
            <div class="flex items-center space-x-4">
                <h2 class="hidden md:block">Disciplinas</h2>
            </div>
          <div>
            <div class="flex space-x-2">
              <template v-if="redirectTo">
                <Link :href="redirectTo" class="px-4 py-2  flex items-center bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                    Regresar
                </Link>
              </template>
              <Link :href="route('manager.areas.disciplines.create', {id: area.id})" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-6d6018c8=""><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-6d6018c8=""></path><line x1="12" y1="5" x2="12" y2="19" data-v-6d6018c8=""></line><line x1="5" y1="12" x2="19" y2="12" data-v-6d6018c8=""></line></svg>
              </Link>
            </div>
          </div>
        </template>
        <template v-slot:content>
          <table-component>
            <template v-slot:thead>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Imagen principal</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Imagen secundaria</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="115">Status</th>
              <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="115">Acciones</th>
            </template>
            <template v-slot:tbody>
              <tr v-for="record in records.data">
                <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                  <Link :href="route('manager.areas.disciplines.show', {area: record.area_id, discipline: record.id})" class="text-blue-500 hover:text-maroon-600">
                    {{ record.name }}
                  </Link>
                </td>
                <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-center">
                  <img :src="`/storage/${record.main_image}`" class="rounded">
                </td>
                <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                  <img :src="`/storage/${record.secondary_image}`" class="rounded">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1  inline-flex rounded-full">
                  {{ record.is_active ? 'Activo' : 'Inactivo' }}
                </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
                  <Link :href="route('manager.areas.disciplines.edit', {area: record.area_id, discipline: record.id})" class="text-blue-500 hover:text-maroon-600">
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
import TableComponent from "@/Components/TableComponent";

export default {
    name: "Coaches",
    components: {
      TableComponent,
      AdminLayout
    },
    props: {
      records: {
        type: Object,
      },
      pagination: {
        type: String,
      },
      area: {
        type: Object
      },
      redirectTo: {
        type: String,
        default: null
      }
    }
}
</script>

<style scoped>

</style>
