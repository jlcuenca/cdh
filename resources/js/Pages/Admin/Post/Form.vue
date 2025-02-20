<template>
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
      <div>
        <div class="mb-4">
          <label class="text-xl text-gray-600">Título</label>
          <input type="text" v-model="form.title" class="border-2 border-gray-300 p-2 w-full rounded" name="title" id="title"  required />
        </div>

        <div class="mb-4">
          <label class="text-xl text-gray-600">Descripción corta</label>
          <textarea v-model="form.excerpt" class="border-2 border-gray-300 p-2 w-full rounded" id="" cols="30" rows="3"></textarea>
        </div>

        <div class="mb-4 text-left">
          <label class="text-xl text-gray-600">Imagen</label>
          <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center grid grid-cols-1">
              <template v-if="preview">
                <img :src="preview" alt="">
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

        <div class="mb-8">
          <label class="text-xl text-gray-600">Contenido</label>

          <ckeditor :editor="editor.object" v-model="form.content" :config="editor.editorConfig"></ckeditor>


        </div>

        <div class="flex p-1">
          <select v-model="form.published" class="border-2 border-gray-300 border-r p-2">
            <option value="">Selecciona</option>
            <option value="1">Guardar y publicar</option>
            <option value="0">Guardar borrador</option>
          </select>
          <button @click="save" class="p-3 bg-blue-500 text-white hover:bg-blue-400">
            Guardar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AdminLayout from "@/Layouts/ManagerLayout";
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import '@ckeditor/ckeditor5-build-classic/build/translations/es';
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  components: {
    AdminLayout,
    ckeditor: CKEditor.component
  },
  props: {
    method: {
      type: String,
      default: 'post'
    },
    action: {
      type: String,
      default: route('manager.posts.store')
    },
    form: {
      type: Object
    }
  },
  data() {
    return {
      preview: null,
      file: null,
      editor: {
        object: ClassicEditor,
        editorData: '<p>Escribe aquí</p>',
        editorConfig: {
          language: 'es',
          uploadUrl: route('manager.multimedia.store')
        }
      }
    }
  },
  methods: {
    handleMainFileUpload() {
      this.file = this.$refs.image.files[0];
      this.preview = URL.createObjectURL(this.file);
    },
    onReady( editor )  {
      // Insert the toolbar before the editable area.
      editor.ui.getEditableElement().parentElement.insertBefore(
          editor.ui.view.toolbar.element,
          editor.ui.getEditableElement()
      );
    },
    save() {

      const formData = new FormData();
      formData.append('title', this.form.title)
      formData.append('excerpt', this.form.excerpt)
      formData.append('content', this.form.content)
      formData.append('published', this.form.published)
      formData.append('file', this.file)
      formData.append('_method', this.method)

      axios({
        method: 'post',
        url: this.action,
        data: formData,
        headers: {
          'content-type': 'multipart/form-data'
        }
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
          window.location = data.redirectTo;
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
