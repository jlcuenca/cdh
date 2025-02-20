<template>
    <admin-layout>
        <template v-slot:head>
            <div class="flex items-center space-x-4">
                <h1 class="hidden md:block">Disciplina:</h1>
                <div class="flex-shrink-0 h-10 w-10 hidden md:block">
                    <img class="h-10 w-10 rounded-full"
                         src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                         alt="">
                </div>
                <h1>---</h1>
            </div>
            <div class="flex space-x-2">
                <Link :href="route('manager.disciplines.index')"
                              class="px-4 py-2  flex items-center bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                    Regresar
                </Link>
            </div>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del curso</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coach</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </template>
                <template v-slot:tbody>
                    <td class="px-6 py-4 whitespace-nowrap  font-medium text-gray-900">
                        <Link class="text-blue-500">---</Link>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                        ---
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                        ---
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left  font-medium">
                        <Link :href="route('manager.courses.edit', {id: 1})" class="text-indigo-600 hover:text-indigo-900">Editar</Link>
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
    name: "Coaches",
    components: {TableComponent, AdminLayout}
}
</script>

<style scoped>

</style>
