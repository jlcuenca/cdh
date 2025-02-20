<template>
  <div class="mt-5 md:mt-0 md:col-span-2">
    <div class="shadow overflow-hidden sm:rounded-md">
      <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-6">
            <label for="first_name" class="block  font-medium text-gray-700">Nombre</label>
            <input type="text" v-model="user.name" id="first_name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
          </div>

          <div class="col-span-6 sm:col-span-4">
            <label for="email_address" class="block  font-medium text-gray-700">Correo electrónico</label>
            <input type="text" v-model="user.email" id="email_address" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
          </div>

          <div class="col-span-6 sm:col-span-6 lg:col-span-2">
            <label for="password" class="block  font-medium text-gray-700">Contraseña</label>
            <input type="password" v-model="user.password" id="password" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
          </div>

        </div>
      </div>
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <button @click="save" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Guardar información
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  props: {
    user: {
      type: Object
    },
    routeUrl: {
      type: String
    }
  },
  methods: {
    save() {
      axios.patch(this.routeUrl, this.user).then(({ data }) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente.',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {

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
