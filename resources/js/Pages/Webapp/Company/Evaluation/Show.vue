<template>
  <page-layout>
    <template v-slot:section>
      <h1>{{  evaluation.title  }}</h1>
    </template>
    <template v-slot:content>
      <table-component>
        <template v-slot:thead>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="350">Correo electrónico</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="60">Status</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="50">Evaluacion</th>
          </tr>
        </template>
        <template v-slot:tbody>
          <tr v-for="record in evaluation.users">
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
              <Link :href="route('webapp.evaluation.employee.show', {evaluation: evaluation.id, employee: record.id})" class="text-indigo-600 hover:text-indigo-900">
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
    TableComponent,
    PageLayout
  },
  props: {
    evaluation: {
      type: Object,
    },
  }
}
</script>
