<template>
  <div class="w-full  font-bold text-gray-700">
    <div class="space-y-6 py-6">
      <div class="space-y-2 text-left">
        <label for="name">Nombre</label>
        <input v-model="employee.name" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="space-y-2 text-left">
          <label for="email">Correo electrónico</label>
          <input v-model="employee.email" type="email" id="email" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe">
        </div>
        <div class="space-y-2 text-left">
          <label for="password">Contraseña</label>
          <input v-model="employee.password" type="password" id="password" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe">
        </div>
      </div>
    </div>
    <div class="space-y-4 border-dotted border-b border-gray-300 py-6">
      <span>Activo:</span>
      <div>
        <input v-model="employee.is_active" type="radio" id="yes" name="gender" value="1" class="transition duration-200">
        <label  for="yes" class="ml-2">Sí</label><br>
        <input v-model="employee.is_active" type="radio" id="no" name="gender" value="0" class="transition duration-200">
        <label for="no" class="ml-2">No</label><br>
      </div>
    </div>
    <div class="py-6 flex space-x-2 justify-center">
      <Link :href="redirect_to" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">Regresar</Link>
      <button @click="doAction" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">Guardar</button>
    </div>
  </div>
</template>

<script>
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  props: {
    employee: {
      type: Object
    },
    company: {
      type: Object
    },
    action: {
      type: String,
      default: 'create'
    },
    route_action: {
      type: String,
    },
    redirect_to: {
      type: String,
    }
  },
  methods: {
    doAction(){
      if (this.action === 'create') {
        this.create();
      } else{
        this.update();
      }
    },
    create() {
      const redirect = this.redirect_to;
      axios.post(this.route_action, this.employee).then(({ data }) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          window.location = redirect;
        });
      }).catch((err) => {
        const errors = AxiosSwalErrorParser(err);
        this.$swal.fire({
          title: 'Atención',
          icon: 'error',
          html: errors.as_html,
          confirmButtonText: 'Entendido'
        });
      });
    },
    update() {
      const redirect = this.redirect_to;
      axios.patch(this.route_action, this.employee).then(({ data }) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          window.location = redirect;
        });
      }).catch((err) => {
        const errors = AxiosSwalErrorParser(err);
        this.$swal.fire({
          title: 'Atención',
          icon: 'error',
          html: errors.as_html,
          confirmButtonText: 'Entendido'
        });
      });
    }
  }
}
</script>
