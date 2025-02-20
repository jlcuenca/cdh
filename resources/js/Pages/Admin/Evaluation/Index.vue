<template>
    <admin-layout>

        <template v-slot:head>
            <h1>Evaluaciones</h1>
            <Link :href="route('manager.evaluation.create')" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-2ea5b8b2=""><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-2ea5b8b2=""></path><line x1="12" y1="5" x2="12" y2="19" data-v-2ea5b8b2=""></line><line x1="5" y1="12" x2="19" y2="12" data-v-2ea5b8b2=""></line></svg>
            </Link>
        </template>
        <template v-slot:content>

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Titulo
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Descripcion
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Secciones
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Empresas
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Secciones
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="record in records.data">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                          <div class=" font-medium text-gray-900">
                            {{ record.title }}
                          </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class=" text-gray-500">
                        {{ record.excerpt }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-500">
                      {{ record.sections_count }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                        {{ record.is_active ? 'Activo' : 'Inactivo' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
                      <a :href="route('manager.evaluation.companies.index', {id: record.id})" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
                      <a :href="route('manager.evaluation.sections.index', {id: record.id})" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center  font-medium">
                      <a :href="route('manager.evaluation.edit', {id: record.id})" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </template>
    </admin-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AdminLayout from "@/Layouts/AdminLayout";

export default {
  components: {
      AdminLayout,
      Link
  },
  props: {
    records: {
      type: Object
    },
    pagination: {
      type: String
    }
  }
}
</script>
