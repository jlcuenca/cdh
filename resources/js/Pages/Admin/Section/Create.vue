<template>
    <admin-layout>
      <div class="py-4 border-b border-gray-300 text-2xl font-bold flex justify-between items-center">
        <h1>Sección</h1>
        <Link :href="backTo" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <line x1="5" y1="12" x2="11" y2="18"></line>
            <line x1="5" y1="12" x2="11" y2="6"></line>
          </svg>
        </Link>
      </div>

      <div>
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
              <p class="mt-1  text-gray-600">
                Después de crear la sección se podrán agregar preguntas y respuestas.
              </p>
            </div>
          </div>
          <div class="mt-5 md:mt-0 md:col-span-2">
            <div>
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                      <label for="title" class="block  font-medium text-gray-700">Título</label>
                      <input type="text" v-model="form.title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md" autofocus>
                    </div>

                    <div class="col-span-6">
                      <label for="excerpt" class="block  font-medium text-gray-700">
                        Descripción
                      </label>
                      <div class="mt-1">
                        <textarea id="excerpt" v-model="form.excerpt" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full  border-gray-300 rounded-md"></textarea>
                      </div>
                      <p class="mt-2  text-gray-500">
                        Brevemente escribe cuál es el objetivo de esta sección
                      </p>
                    </div>

                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button @click="save" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar y continuar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </admin-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AdminLayout from "@/Layouts/ManagerLayout";
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  components: {
    AdminLayout,
      Link,
  },
  props: {
    diagnose: {
      type: Object
    },
    backTo: {
      type: String
    }
  },
  data() {
    return {
      form: {
        title: '',
        excerpt: '',
      }
    }
  },
  methods: {
    save() {
      axios({
        method: 'post',
        url: route('manager.evaluation.sections.store', {id: this.diagnose.id}),
        data: this.form,
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
