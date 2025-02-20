<template>
  <div class="w-full font-bold text-gray-700">
    <div class="space-y-6">
      <div class="space-y-2 text-left">
        <label for="name">Título</label>
        <input v-model="content.title" type="text" id="name" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
      </div>
      <div class="space-y-2 text-left">
        <label for="excerpt">Descripción corta de la clase</label>
        <textarea v-model="content.excerpt" rows="6" type="text" id="excerpt" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2"></textarea>
      </div>
        <div class="space-y-2 text-left">
            <label>Imagen previa</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center grid grid-cols-1">
                    <template v-if="preview || content.thumbnail_url">
                        <template v-if="preview">
                            <img :src="preview" alt="">
                        </template>
                        <template v-else>
                            <img :src="`/storage/${content.thumbnail_url}`" alt="">
                        </template>
                    </template>
                    <template v-else>
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </template>
                    <div class="flex text-gray-600 mx-auto py-2">
                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Seleccionar imagen</span>
                            <input id="file-upload" name="file-upload" ref="image" type="file" accept="image/*" v-on:change="handleMainFileUpload" class="sr-only">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-4 py-6">
        <div class="space-y-2 text-left mb-4">
            <label>Duración del video ó de la clase</label>
            <div class="flex space-x-2">
                <div class="flex items-center space-x-2">
                    <label for="hh">Horas</label>
                    <select v-model="content.hours_duration" id="hh" class="pr-10 py-2 shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100">
                        <option value="">Selecciona</option>
                        <option v-for="n in options.hh" :value="n">{{ n }}</option>
                    </select>
                </div>
                <div class="flex items-center space-x-2">
                    <label for="mm">Minutos</label>
                    <select v-model="content.minutes_duration" id="mm" class="pr-10 py-2 shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100">
                        <option value="">Selecciona</option>
                        <option v-for="n in options.mm" :value="n">{{ n }}</option>
                    </select>
                </div>
            </div>
        </div>
      <div class="space-y-2 text-left">
        <label for="origin">Origen del vídeo</label>
        <select v-model="content.video_source" id="origin" class="w-full shadow-sm rounded-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2">
          <option value="">Selecciona</option>
          <option value="vimeo">Vimeo</option>
          <!--<option value="youtube">Youtube</option>-->
        </select>
      </div>
      <div class="space-y-2 text-left" v-if="content.video_source">
        <label for="url">URL</label>
        <div class="flex">
          <span :style="options[content.video_source].w" class="rounded-l-md py-2 px-4 bg-gray-100 border-t border-l border-b border-gray-300 flex items-center w-56">
            {{ options[content.video_source].url }}
          </span>
          <input v-model="content.video_url" type="text" id="url" class="w-full shadow-sm rounded-r-md border border-gray-300 focus:border-blue-500 transition duration-100 p-2" :placeholder="`Ej. ${options[content.video_source].placeholder}`">
        </div>
      </div>
    </div>
      <div class="space-y-4 border-dotted border-b border-gray-300 py-6">
        <label for="is_active">Estado :</label>
        <select v-model="content.is_active" id="is_active" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="1">Publicado</option>
            <option value="0">No publicado</option>
        </select>
    </div>
    <div class="py-6 flex space-x-2 justify-center">
      <Link :href="backTo" class="px-4 py-2 bg-white hover:bg-gray-100 border border-gray-100 focus:outline-none transition duration-100 rounded-md shadow">
        Regresar
      </Link>
      <button @click="save" class="px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none transition duration-100 rounded-md shadow">
        {{ textButton }}
      </button>
    </div>
  </div>
</template>


<script>
import {Link} from "@inertiajs/inertia-vue3";
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
    props: {
        course: {
            type: Object
        },
        content: {
            type: Object
        },
        action: {
            type: String,
            default: 'post'
        },
        routeAction: {
            type: String,
        },
        backTo: {
            type: String,
        },
      textButton: {
        type: String,
        default: "Crear"
      }
  },
    components: {
        Link,
    },
  data() {
    return {
      preview: null,
      file: null,
      options: {
        hh: ['00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15', '16', '17','18', '19', '20', '21', '22', '23', '24'],
        mm: ['00' ,'01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60'],
        vimeo: {
          w: '',
          url: 'https://vimeo.com/',
          placeholder: '347119375'
        },
        youtube: {
          w: 'width: 382px;',
          url: 'https://www.youtube.com/watch?v=',
          placeholder: 'K4TOrB7at0Y'
        },
      }
    }
  },
  methods: {
    handleMainFileUpload() {
      this.file = this.$refs.image.files[0];
      this.preview = URL.createObjectURL(this.file);
    },
    save() {
      const redirect = this.backTo;

      const config = {
        'content-type': 'multipart/form-data'
      };

      const formData = new FormData();
      formData.append('title', this.content.title)
      formData.append('excerpt', this.content.excerpt)
      formData.append('hours_duration', this.content.hours_duration)
      formData.append('minutes_duration', this.content.minutes_duration)
      formData.append('video_url', this.content.video_url)
      formData.append('video_source', this.content.video_source)
      formData.append('score', this.content.score)
      formData.append('is_active', this.content.is_active)
      formData.append('file', this.file)
      formData.append('user_id', this.content.user_id)
      formData.append('_method', this.action)

      axios({
        method: 'post',
        url: this.routeAction,
        data: formData,
        headers: config
      }).then(({data}) => {
        this.$swal.fire({
          title: 'Éxito',
          icon: 'success',
          text: 'La información ha sido guardada correctamente. Ahora puedes agregar materiales a esta clase',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
            window.location = data.redirect;
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
          text: 'La información ha sido guardada correctamente.',
          confirmButtonText: 'Entendido',
          allowOutsideClick: false,
          allowEscapeKey: false,
          allowEnterKey: false,
        }).then(() => {
          //
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
