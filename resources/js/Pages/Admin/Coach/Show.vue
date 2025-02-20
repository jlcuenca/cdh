<template>
    <admin-layout>
        <template v-slot:head>
            <div class="w-full">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                            {{ student.name }}
                        </h2>
                        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                            <div class="mt-2 flex items-center  text-gray-500">
                                {{ student.email }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 flex lg:mt-0 lg:ml-4">
                        <a :href="route('manager.users.edit', student.id)" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm  font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <!-- Heroicon name: solid/pencil -->
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </template>
        <template v-slot:content>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <div class="text-2xl  mb-4">Cursos por asignar</div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Curso
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Lecciones
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="course in availableCourses">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full" :src="`/storage/${course.image_url}`" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-medium text-blue-500">
                                                                {{ course.title }}
                                                            </div>
                                                            <div class=" text-gray-500">
                                                                {{ course.hours_minutes }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class=" text-gray-900">
                                                        {{ course.lessons_count }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <button type="button" @click="subscribe(course)" class="px-2 py-1 rounded inline-flex leading-5 font-semibold  bg-blue-500 text-white hover:bg-blue-600 mx-auto">
                                                      Asignar
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-2xl  mb-4">Cursos asignados</div>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Curso
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Lecciones
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Avance
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="course in registeredCourses">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full" :src="`/storage/${course.image_url}`" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-medium text-blue-500">
                                                                {{ course.title }}
                                                            </div>
                                                            <div class=" text-gray-500">
                                                                {{ course.hours_minutes }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class=" text-gray-900">
                                                        {{ course.lessons_count }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="block  w-full">
                                                        <template v-if="course.progress_count > 0">
                                                            <div class="bg-gray-200 rounded-full">
                                                                <div :class="course.lessons_completed_count > 0 ? `w-${Math.round(course.lessons_completed_count * 12 / course.lessons_count)}/12 bg-green-500` : 'w-1/12'" class="py-0 rounded-full">
                                                                    <div class=" text-white text-xs inline-block bg-maroon-700 px-2 rounded-full">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                        <template v-else>
                                                            <div class="block  w-full"><div class="bg-gray-200 rounded-full"><div class="w-1/12 py-0 rounded-full"><div class=" text-white text-xs inline-block bg-maroon-700 px-2 rounded-full"></div></div></div></div>
                                                        </template>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </template>
    </admin-layout>

</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AdminLayout,
        Link
    },
    props: ['student', 'availableCourses', 'registeredCourses'],
    methods: {
        subscribe(course) {

            axios.post(route('manager.course.subscription.update', course.id), {
                user: this.student.id,
            }).then(({ data }) => {
                location.reload();
            }).catch((err) => {

            });

        }
    }
}
</script>
