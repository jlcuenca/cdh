<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Editando Clase: </h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
                <form class="w-full  font-bold text-gray-700">
                    <div class="py-6 space-y-6">
                        <div class="space-y-2 text-left">
                            <label for="name">Título</label>
                            <input v-model="form.name" type="text" id="name"
                                   class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="excerpt">Descripción</label>
                            <textarea v-model="form.excerpt" rows="6" type="text" id="excerpt"
                                      class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"></textarea>
                        </div>
                        <div class="space-y-2 text-left">
                            <label>Duración</label>
                            <div class="flex space-x-2">
                                <div class="flex items-center space-x-2">
                                    <label for="hh">HH</label>
                                    <select v-model="form.hh" type="text" id="hh" class="px-8 shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre...">
                                        <option v-for="n in 24" default-value="0"> {{ n }} </option>
                                    </select>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="mm">MM</label>
                                    <select v-model="form.mm" type="text" id="mm" class="px-8 shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre...">
                                        <option v-for="n in 60" default-value="0"> {{ n  }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 py-6">
                        <div class="space-y-2 text-left">
                            <label>Vista previa del vídeo</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="flex  text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Subir imagen</span>
                                            <input id="file-upload" name="file-upload" :class="form.thumbnail" type="file" class="sr-only">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="origin">Origen del vídeo</label>
                            <select v-model="form.origin" type="text" id="origin"
                                    class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"
                                    placeholder="Nombre...">
                                <option value="0">---</option>
                                <option value="1">Vimeo</option>
                                <option value="2">Youtube</option>
                            </select>
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="url">URL</label>
                            <div class="flex">
                                <span class="rounded-l-md py-2 px-4 bg-gray-100 border-t border-l border-b border-gray-300 flex items-center">http://</span>
                                <input v-model="form.url" type="text" id="url"
                                       class="w-full shadow-sm rounded-r-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"
                                       placeholder="example.com">
                            </div>
                        </div>

                    </div>
                    <div class="space-y-4 border-dotted border-b border-gray-300 py-6">
                        <span>Activo:</span>
                        <div>
                            <input v-model="form.active" type="radio" id="yes" name="gender" value="1"
                                   class="transition duration-200">
                            <label for="yes" class="ml-2">Sí</label><br>
                            <input v-model="form.active" type="radio" id="no" name="gender" value="0"
                                   class="transition duration-200">
                            <label for="no" class="ml-2">No</label><br>
                        </div>
                    </div>
                    <div class="py-6 flex space-x-2 justify-center">
                        <Link :href="route('manager.courses.show', {id: 1})"
                                      class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                            Regresar
                        </Link>
                        <button
                            class="px-4 py-2 bg-green-500 text-white hover:bg-green-600 focus:outline-none transition duration-100 rounded-md shadow">
                            Editar
                        </button>
                    </div>
                </form>
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";

export default {
    components: {AdminLayout},
    data() {
        return {
            form: {
                name: '',
                excerpt: '',
                hh: 0,
                mm: 0,
                thumbnail: '',
                url: '',
                origin: '',
                active: 1,
            },
            hours: 0,
            minutes: 0
        }
    },
}
</script>

<style scoped>

</style>
