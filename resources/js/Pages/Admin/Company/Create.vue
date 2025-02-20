<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Empresa</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
                <div class="w-full  text-gray-700 font-bold">
                    <div class="space-y-6 py-6">
                        <div class="space-y-2 text-left">
                            <label for="company_name">Nombre de la empresa</label>
                            <input v-model="form.company_name" type="text" id="company_name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre de la empresa">
                        </div>
                        <div class="space-y-2 text-left">
                            <label for="name">Nombre del responsable</label>
                            <input v-model="form.name" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Nombre">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
                            <div class="space-y-2 text-left">
                                <label for="email">Correo electrónico</label>
                                <input v-model="form.email" type="email" id="email" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Correo electrónico">
                            </div>
                            <div class="space-y-2 text-left">
                                <label for="password">Contraseña</label>
                                <input v-model="form.password" type="password" id="password" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="space-y-2 text-left">
                          <label for="max_number_of_employees">Número máximo de empleados</label>
                          <input v-model="form.max_number_of_employees" type="number" id="max_number_of_employees" min="1" max="999999" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="100">
                        </div>
                    </div>
                    <div class="space-y-4 border-dotted border-b border-gray-300 py-6">
                        <span>Activo:</span>
                        <div>
                            <input v-model="form.active" type="radio" id="yes" name="gender" value="1" class="transition duration-200">
                            <label  for="yes" class="ml-2">Sí</label><br>
                            <input v-model="form.active" type="radio" id="no" name="gender" value="0" class="transition duration-200">
                            <label for="no" class="ml-2">No</label><br>
                        </div>
                    </div>
                    <div class="py-6 flex space-x-2 justify-center">
                        <Link :href="route('manager.companies.index')" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">Regresar</Link>
                        <button @click="save" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">Crear</button>
                    </div>
                </div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  components: {
    AdminLayout
  },
  data() {
    return {
      form: {
        company_name: '',
        name: '',
        email: '',
        password: '',
        active: 1,
        max_number_of_employees: 1,
      }
    }
  },
  methods: {
    save() {
      axios.post(route('manager.companies.store'), this.form).then(({ data }) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente, ahora agreguemos algunos empleados',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          window.location = route('manager.companies.show', {id: data.id });
        });
      }).catch((err) => {
        const errors = AxiosSwalErrorParser(err);
        this.$swal.fire({
          title: 'Atención',
          icon: 'error',
          html: errors.as_html,
          confirmButtonText: 'Entendido'
        });
      })
    }
  }
}
</script>
