<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Creando nuevo Curso</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
                <form class="w-full  font-bold text-gray-700">
                    <div class="py-6 space-y-6">
                        <div class="space-y-2 text-left">
                            <label for="discipline">Disciplina</label>
                            <select v-model="form.coach" type="text" id="discipline" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre...">
                                <option value="0">---</option>
                            </select>
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="coach">Coach</label>
                            <select v-model="form.coach" type="text" id="coach" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre...">
                                <option value="0">---</option>
                            </select>
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="name">Nombre del curso</label>
                            <input v-model="form.name" type="text" id="name"
                                   class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"
                                   placeholder="Nombre...">
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="excerpt">Descripción del curso</label>
                            <textarea v-model="form.excerpt" rows="6" type="text" id="excerpt"
                                      class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"></textarea>
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
                        <Link :href="route('manager.trainings.index')"
                                      class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
                            Regresar
                        </Link>
                        <button
                            class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">
                            Crear
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
                discipline: 1,
                name: '',
                excerpt: '',
                coach: 1,
                active: 1
            }
        }
    }
}
</script>

<style scoped>

</style>
