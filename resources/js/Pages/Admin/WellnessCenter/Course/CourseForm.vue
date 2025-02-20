<template>
  <div class="w-full  font-bold text-gray-700">
    <div class="py-6 space-y-6">
      <template v-if="category === 'wellness'">
        <div class="space-y-2 text-left">
          <label for="area">Área</label>
          <select v-model="content.area_id" id="area" @change="selectHandler" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
            <option value="">Selecciona</option>
            <option v-for="area in areas" :value="area.id">{{ area.name }}</option>
          </select>
        </div>
      </template>
      <template v-if="['wellness', 'training'].includes(category)">
        <div class="space-y-2 text-left">
          <label for="discipline">{{ category ==='wellness' ? ' Disciplina' : 'Tema'}}</label>
          <select v-model="content.discipline_id" id="discipline" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
            <option value="">Selecciona</option>
            <option v-for="discipline in list_disciplines" :value="discipline.id">{{ discipline.name }}</option>
          </select>
        </div>
      </template>
      <div class="space-y-2 text-left" v-if="category === 'wellness'">
        <label for="coach">Coach</label>
        <select v-model="content.user_id" id="coach" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
          <option value="">Selecciona</option>
          <option v-for="trainer in trainers" :value="trainer.id">{{ trainer.name }}</option>
        </select>
      </div>
      <div class="space-y-2 text-left">
        <label for="name">Título</label>
        <input v-model="content.title" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" placeholder="Escribe">
      </div>
      <div class="space-y-2 text-left">
        <label for="excerpt">Descripción corta del curso</label>
        <textarea v-model="content.excerpt" rows="6" id="excerpt" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"></textarea>
      </div>
    </div>
    <div class="space-y-4 py-6">
      <div class="space-y-2 text-left">
        <label>Imagen (Opcional)</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
          <div class="space-y-1 text-center grid grid-cols-1">
            <template v-if="preview || content.image_url">
              <template v-if="preview">
                <img :src="preview" alt="">
              </template>
              <template v-else>
                <img :src="`/storage/${content.image_url}`" alt="">
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
                <input id="file-upload" name="file-upload" ref="image" type="file" accept="image/*" v-on:change="handleMainFileUpload" class="sr-only">
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
        <label for="yes" class="ml-2">Sí</label><br>
        <input v-model="content.is_active" type="radio" id="no" name="gender" value="0" class="transition duration-200">
        <label for="no" class="ml-2">No</label><br>
      </div>
    </div>
    <div class="py-6 flex space-x-2 justify-center">
      <Link :href="redirectTo" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
        Regresar
      </Link>
      <button @click="doAction" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">
        {{ method === 'post' ? 'Guardar' : 'Actualizar' }}
      </button>
    </div>
  </div>
</template>

<script>
import {AxiosSwalErrorParser} from "@/parser_swal";
import 'dropzone-vue/dist/dropzone-vue.common.css';
import DropZone from 'dropzone-vue';

export default {
  props: [
      'content',
    'redirectTo', 'routeAction', 'action', 'category'
  ],
    components: {
        DropZone
    },
  data() {
    return {
      list_disciplines: [],
      preview: null,
      file: null,
      messages: {
        post: 'Información guardada correctamente, ahora agreguemos algunas clases',
        patch: 'Información guardada correctamente'
      }
    }
  },
  methods: {
    handleMainFileUpload() {
      this.file = this.$refs.image.files[0];
      this.preview = URL.createObjectURL(this.file);
    },
    selectHandler() {
      this.content.discipline_id = '';
      this.list_disciplines = this.disciplines.filter((item) => {
        return item.area_id === this.content.area_id;
      });
    },
    doAction() {
      let redirect = this.redirectTo;
      const action = this.action;
      const message = this.messages[action];

      this.content.category = this.category;

      const config = {
        'Content-Type': 'multipart/form-data'
      };

      const formData = new FormData();

      formData.append('title', this.content.title)
      formData.append('excerpt', this.content.excerpt)
      formData.append('_method', this.action)

      if (this.file) {
        formData.append('image', this.file)
      }

      formData.append('is_active', this.content.is_active)

      axios({
        method: 'post',
        url: this.routeAction,
        data: formData,
        headers: config
      }).then(({data}) => {

        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: message,
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          if (action === 'post') {
            redirect = `${redirect}/${data.id}/lessons`;
            window.location = redirect;
          }
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
  },
  mounted() {
    this.list_disciplines = this.disciplines;
  }
}
</script>
