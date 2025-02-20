<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Curso: </h1>
            <div class="flex space-x-2">
                <Link :href="route('manager.courses.index')"
                              class="px-4 py-2  flex items-center bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                    Regresar
                </Link>
                <Link :href="route('manager.courses.lessons.create', {id: 1})"
                              class="rounded-md px-4 py-2 shadow bg-blue-500 text-white text-base hover:bg-blue-600 transition duration-100 flex items-center space-x-2 justify-center content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <h2>Nueva Clase</h2>
                </Link>
            </div>
        </template>
        <template v-slot:description>
            <div class="px-6 py-4 text-left text-gray-700">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet aspernatur eos esse excepturi inventore maiores molestiae, nisi odio perferendis, perspiciatis qui recusandae rerum, sapiente totam veritatis vitae? Quia, sunt.
                </p>
            </div>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre de la clase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Origen del vídeo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </template>
                <template v-slot:tbody>
                    <td class="px-6 py-4 whitespace-nowrap ">
                        <div class="flex items-center">
                            <Link>
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full"
                                         src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                         alt="">
                                </div>
                            </Link>
                            <div class="ml-4">
                                <div class="font-medium text-blue-500">
                                    <Link>---</Link>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                        ---
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900 flex space-x-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <polyline points="12 7 12 12 15 15"></polyline>
                        </svg>
                        <h2>-- : -- : --</h2>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap  text-gray-900">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                      Youtube
                    </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Active
                    </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-left  font-medium">
                        <Link  class="text-indigo-600 hover:text-indigo-900">Editar</Link>
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
