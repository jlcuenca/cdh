<template>
    <div>
      <table-component>
        <template v-slot:thead>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del curso</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coach</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disciplina</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </template>
        <template v-slot:tbody>
          <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
            <Link :href="route('manager.trainings.show',{id: 1 })" class="text-blue-500">Hola</Link>
          </td>
          <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
            ---
          </td>
          <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
            ---
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                      ---
                    </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-left  font-medium">
            <Link :href="route('manager.courses.edit',{id: 1 })" class="text-indigo-600 hover:text-indigo-900">Editar</Link>
          </td>
        </template>
      </table-component>
      <div></div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";

export default {
    components: {TableComponent, AdminLayout}
}
</script>
