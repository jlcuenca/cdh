<template>
    <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6 space-y-2">
                <div class="col-span-6">
                    <label for="first-name" class="block mb-2 font-medium text-gray-700">Nombre</label>
                    <input v-model="content.firstname" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe aquí">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block mb-2 font-medium text-gray-700">Apellido paterno</label>
                    <input v-model="content.paternal_lastname" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe aquí">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block mb-2 font-medium text-gray-700">Apellido materno</label>
                    <input v-model="content.maternal_lastname" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe aquí">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email-address" class="block mb-2 font-medium text-gray-700">Correo electrónico</label>
                    <input v-model="content.email" type="email" id="email" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe aquí">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email-address" class="block mb-2 font-medium text-gray-700">Contraseña</label>
                    <input v-model="content.password" type="password" id="password" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Opcional">
                    <p class="text-xs text-gray-600 mt-1">Escribe aqui si deseas asignar una contraseña</p>
                </div>

                <div class="col-span-6 sm:col-span-2">
                    <label for="street-address" class="block mb-2 font-medium text-gray-700">Fecha de nacimiento</label>
                    <input v-model="content.date_of_birth" type="date" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="street-address" class="block mb-2 font-medium text-gray-700">Genero</label>
                    <select v-model="content.gender" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
                        <option value="">Selecciona</option>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                        <option value="unknown">No especificado</option>
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <label for="street-address" class="block mb-2 font-medium text-gray-700">Teléfono</label>
                    <input v-model="content.phone" type="text" name="street-address" id="street-address" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                    <label for="street-address" class="block mb-2 font-medium text-gray-700">Dirección</label>
                    <input v-model="content.address" type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                    <label for="city" class="block mb-2 font-medium text-gray-700">Municipio</label>
                    <select v-model="content.city_name" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
                        <option v-for="city in cities" :value="city.value">{{ city.text }}</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label for="region" class="block mb-2 font-medium text-gray-700">Estado</label>
                    <select v-model="content.state_name" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
                        <option value="morelos">Morelos</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <label for="postal-code" class="block mb-2 font-medium text-gray-700">Código postal</label>
                    <input v-model="content.postal_code"  type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <div class="py-6 flex space-x-2 justify-center">
            <Link :href="route('manager.coaches.index')" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">Regresar</Link>
            <button @click="doAction" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">
                {{ action === 'post' ? 'Crear' : 'Actualizar' }}
            </button>
        </div>
    </div>

</template>

<script>
import {AxiosSwalErrorParser} from "@/parser_swal";
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
  props: {
    origin: {
      type: String,
      default: 'none'
    },
    action: {
      type: String,
      default: 'post'
    },
    content: {
      type: Object
    },
    route_action: {
      type: String,
    },
    redirect_to: {
        type: String,
        default: ''
    }
  },
  data() {
    return {
      file: null,
      preview: null,
        cities: [
            {'text': 'Selecciona', 'value': null},
            {'text': 'Amacuzac', 'value': 'Amacuzac'},
            {'text': 'Atlatlahucan', 'value': 'Atlatlahucan'},
            {'text': 'Axochiapan', 'value': 'Axochiapan'},
            {'text': 'Ayala', 'value': 'Ayala'},
            {'text': 'Coatlán del Río', 'value': 'Coatlán del Río'},
            {'text': 'Cuautla', 'value': 'Cuautla'},
            {'text': 'Cuernavaca', 'value': 'Cuernavaca'},
            {'text': 'Coatetelco', 'value': 'Coatetelco'},
            {'text': 'Emiliano Zapata', 'value': 'Emiliano Zapata'},
            {'text': 'Huitzilac', 'value': 'Huitzilac'},
            {'text': 'Hueyapan', 'value': 'Hueyapan'},
            {'text': 'Jantetelco', 'value': 'Jantetelco'},
            {'text': 'Jiutepec', 'value': 'Jiutepec'},
            {'text': 'Jojutla', 'value': 'Jojutla'},
            {'text': 'Jonacatepec de Leandro Valle', 'value': 'Jonacatepec de Leandro Valle'},
            {'text': 'Mazatepec', 'value': 'Mazatepec'},
            {'text': 'Miacatlán', 'value': 'Miacatlán'},
            {'text': 'Ocuituco', 'value': 'Ocuituco'},
            {'text': 'Puente de Ixtla', 'value': 'Puente de Ixtla'},
            {'text': 'Temixco', 'value': 'Temixco'},
            {'text': 'Tepalcingo', 'value': 'Tepalcingo'},
            {'text': 'Temoac', 'value': 'Temoac'},
            {'text': 'Tepoztlán', 'value': 'Tepoztlán'},
            {'text': 'Tetecala', 'value': 'Tetecala'},
            {'text': 'Tetela del Volcán', 'value': 'Tetela del Volcán'},
            {'text': 'Tlalnepantla', 'value': 'Tlalnepantla'},
            {'text': 'Tlaltizapán de Zapata', 'value': 'Tlaltizapán de Zapata'},
            {'text': 'Tlaquiltenango', 'value': 'Tlaquiltenango'},
            {'text': 'Tlayacapan', 'value': 'Tlayacapan'},
            {'text': 'Totolapan', 'value': 'Totolapan'},
            {'text': 'Xochitepec', 'value': 'Xochitepec'},
            {'text': 'Yautepec', 'value': 'Yautepec'},
            {'text': 'Yecapixtla', 'value': 'Yecapixtla'},
            {'text': 'Zacatepec', 'value': 'Zacatepec'},
            {'text': 'Zacualpan de Amilpas', 'value': 'Zacualpan de Amilpas'},
            {'text': 'Xoxocotla', 'value': 'Xoxocotla'},

        ]
    }
  },
  methods: {
    handleMainFileUpload() {
      this.file = this.$refs.image.files[0];
      this.preview = URL.createObjectURL(this.file);
    },
    doAction() {
      axios({
        method: this.action,
        url: this.route_action,
        data: this.content,
      }).then(({data}) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente.',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          window.location = route('manager.users.show', data.id);
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
