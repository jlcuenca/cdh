<template>
    <admin-layout>
        <template v-slot:head>
            <h1>{{ evaluation.title }}</h1>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Empleados</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" width="150">Máximo empleados</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" width="115">Acciones</th>
                </template>
                <template v-slot:tbody>
                  <tr v-for="record in companies.data">
                    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                        <Link :href="route('manager.evaluation.companies.show', {'evaluation': evaluation.id, 'company': record.id})" class="text-blue-500 hover:text-maroon-600">
                          {{ record.name }}
                        </Link>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-center">
                        {{ record.employees_evaluation_count }} / {{ record.employees_count }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span :class="record.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'" class="px-2 py-1  inline-flex rounded-full">
                        {{ record.is_active ? 'Activo' : 'Inactivo' }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center font-medium">
                      <Link :href="route('manager.evaluation.companies.show', {'evaluation': evaluation.id, 'company': record.id})" class="text-blue-500 hover:text-maroon-600">
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
    evaluation: {
      type: Object,
    },
    companies: {
      type: Object,
    },
    pagination: {
      type: String,
    }
  }
}
</script>
