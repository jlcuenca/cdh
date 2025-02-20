<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Capacitación: Cursos</h1>
            <Link :href="route('manager.trainings.create')"
                          class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </Link>
        </template>
        <template v-slot:content>
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
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";

export default {
    components: {TableComponent, AdminLayout}
}
</script>

<style scoped>

</style>
