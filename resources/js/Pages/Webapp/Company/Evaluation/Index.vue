<template>
    <page-layout>
        <template v-slot:section>
            <h1>Diagnósticos</h1>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Empleados</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="115"></th>
                </template>
                <template v-slot:tbody>
                  <tr v-for="record in evaluations.data">
                    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                       {{ record.title }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-center">
                      {{ record.users_count }} / {{ employeesCount }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
                      <Link :href="route('webapp.company-evaluation.show', {'company_evaluation': record.id})" class="text-blue-500 hover:text-maroon-600">
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
    evaluations: {
      type: Object,
    },
    pagination: {
      type: String,
    },
    employeesCount: {
      type: Number
    }
  }
}
</script>
