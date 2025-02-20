<template>
  <div class="w-full  font-bold">
    <div class="py-6">
      <div class="space-y-2 text-left">
        <label for="name">Nombre</label>
        <input v-model="content.name" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2 placeholder-gray-500" placeholder="Escribe" autofocus>
      </div>
    </div>
    <div class="py-6 space-y-6">
      <div class="space-y-2 text-left">
        <label>Imagen principal</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
          <div class="space-y-1 grid grid-cols-1 text-center">
            <template v-if="preview.main || content.main_image">
              <template v-if="preview.main">
                <img :src="preview.main" alt="">
              </template>
              <template v-else>
                <img :src="`/storage/${content.main_image}`" alt="">
              </template>
            </template>
            <template v-else>
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </template>
            <div class="flex  text-gray-600 mx-auto py-2">
              <label for="main-image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <span>Seleccionar imagen</span>
                <input id="main-image" ref="main_image" name="file-upload" type="file" accept="image/*" v-on:change="handleMainFileUpload" class="sr-only">
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="space-y-2 text-left">
        <label>Imagen secundaria</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
          <div class="space-y-1 text-center grid grid-cols-1">
            <template v-if="preview.secondary || content.secondary_image">
              <template v-if="preview.secondary">
                <img :src="preview.secondary" alt="">
              </template>
              <template v-else>
                <img :src="`/storage/${content.secondary_image}`" alt="">
              </template>
            </template>
            <template v-else>
              <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </template>
            <div class="flex  text-gray-600 mx-auto py-2">
              <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <span>Seleccionar imagen</span>
                <input id="file-upload" name="file-upload" ref="secondary_image" type="file" accept="image/*" v-on:change="handleSecondaryFileUpload" class="sr-only">
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="space-y-4 border-dotted border-b border-gray-300 py-6">
      <span>Activo:</span>
      <div>
        <input v-model="content.is_active" type="radio" id="yes" name="gender" value="1" class="transition duration-200">
        <label  for="yes" class="ml-2">Sí</label><br>
        <input v-model="content.is_active" type="radio" id="no" name="gender" value="0" class="transition duration-200">
        <label for="no" class="ml-2">No</label><br>
      </div>
    </div>
    <div class="py-6 flex space-x-2 justify-center">
      <Link :href="redirect_to" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">Regresar</Link>
      <button @click="doAction" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">
       {{ action === 'post' ? 'Crear' : 'Actualizar' }}
      </button>
    </div>
  </div>
</template>

<script>
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
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
    }
  },
  data() {
    return {
      file: {
        main: null,
        secondary: null
      },
      preview: {
        main: null,
        secondary: null
      },
      messages: {
        area: {
          post : 'La información ha sido guardada correctamente, ahora vamos a agregar algunas disciplinas.',
          patch : 'La información ha sido guardada correctamente',
        },
        discipline: {
          post : 'La información ha sido guardada correctamente',
          patch : 'La información ha sido guardada correctamente',
        },
        none: {
          post : 'La información ha sido guardada correctamente',
          patch : 'La información ha sido guardada correctamente',
        }
      }
    }
  },
  methods: {
    handleMainFileUpload() {
      this.file.main = this.$refs.main_image.files[0];
      this.preview.main = URL.createObjectURL(this.file.main);
    },
    handleSecondaryFileUpload() {
      this.file.secondary = this.$refs.secondary_image.files[0];
      this.preview.secondary = URL.createObjectURL(this.file.secondary);
    },
    doAction() {
      let redirect = this.redirect_to;
      const action = this.action;
      const message = this.messages[this.origin][action];
      const config = {
        'content-type': 'multipart/form-data'
      };

      const formData = new FormData();
      formData.append('name', this.content.name)
      formData.append('main_image', this.file.main)
      formData.append('secondary_image', this.file.secondary)
      formData.append('is_active', this.content.is_active)
      formData.append('_method', this.action)

      axios({
        method: 'post',
        url: this.route_action,
        data: formData,
        headers: config
      }).then(({data}) => {

        if (this.origin === 'area') {
          redirect = (action === 'post') ? `${redirect}/${data.id}` : redirect;
        }

        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: message,
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
