<template>
    <admin-layout>

      <div class="grid grid-cols-1 text-xl font-bold flex items-center">
        <p>Evaluacion: {{ diagnose.title }}</p>
        <p>Sección: {{ diagnoseSection.title }}</p>
      </div>

      <div class="py-4 border-b border-gray-300 text-2xl font-bold flex justify-between items-center">
        <h1>Pregunta</h1>
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

          <div class="mt-5 md:mt-0 md:col-span-2">
            <div>
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6">
                      <label for="title" class="block  font-medium text-gray-700">Título</label>
                      <input type="text" id="title" v-model="form.title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm  border-gray-300 rounded-md" autofocus>
                    </div>

                    <div class="col-span-6">
                      <label for="about" class="block  font-medium text-gray-700">
                        Descripción
                      </label>
                      <div class="mt-1">
                        <textarea id="about" v-model="form.description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full  border-gray-300 rounded-md"></textarea>
                      </div>
                      <p class="mt-2  text-gray-500">
                        Brevemente escribe cuál es el objetivo de esta pregunta (Opcional)
                      </p>
                    </div>
                    <div class="col-span-6">
                      <label for="answer_type" class="block  font-medium text-gray-700">Tipo de respuestas</label>
                      <select id="answer_type" v-model="form.answers_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 ">
                        <option value="">Selecciona</option>
                        <option value="true_false">Si / No</option>
                        <option value="group_of_data">Algunas veces, Siempre, Casi Nunca, etc...</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button @click="save" type="button" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm  font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Guardar
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3">
            <div class="flex items-center justify-center">
              <div class="flex flex-col w-full bg-white rounded shadow-lg">
                <div class="flex flex-col w-full md:flex-row">
                  <div class="font-normal text-gray-800 w-full">
                    <div class="p-6">
                      <h1 class="mb-4 text-lg font-bold leading-none tracking-tight text-gray-800">
                        {{ form.title }}
                      </h1>
                      <p class="leading-normal">{{ form.excerpt}}</p>
                      <div class="flex flex-row items-center mt-4 text-gray-700 w-full">
                        <template v-if="form.answers_type !== ''">
                          <div :class="form.answers_type === 'group_of_data' ? 'sm:grid-cols-5 gap-x-2': 'sm:grid-cols-2 gap-x-6'" class="grid grid-cols-1 w-full">
                            <template v-for="(item, index) in answers_list[form.answers_type]">
                              <label :for="`${index}-qa`" :class="item.value === example.group_of_data ? 'bg-maroon-500 text-white border-maroon-200 border-2' : 'bg-gray-100'" class="w-full rounded-full px-4 py-1 hover:bg-maroon-500 hover:text-white cursor-pointer text-center">
                                {{ item.name }}
                              </label>
                              <input type="radio" :id="`${index}-qa`" class="hidden" :value="item.value" name="answer" v-model="example.group_of_data" />
                            </template>
                          </div>
                        </template>
                      </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                      <button type="button" :class="example.true_false !=='' ? 'text-white bg-indigo-600 hover:bg-indigo-700': 'text-indigo-300 border border-indigo-300'" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm  font-medium rounded-full  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"> Siguiente </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/ManagerLayout";
import {AxiosSwalErrorParser} from "@/parser_swal";

export default {
  components: {
    AdminLayout
  },
  props: {
    diagnose: {
      type: Object
    },
    diagnoseSection: {
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
        description: null,
        answers_type: ''
      },
      answers_list: {
        true_false: [
          {'name': 'Si', 'value': 'yes'},
          {'name': 'No', 'value': 'no'},
        ],
        group_of_data: [
          {'name': 'Siempre', 'value': 'always'},
          {'name': 'Casi siempre', 'value': 'usually'},
          {'name': 'Algunas veces', 'value': 'sometimes'},
          {'name': 'Casi nunca', 'value': 'rarely'},
          {'name': 'Nunca', 'value': 'never'},
        ]
      },
      example: {
        true_false: '',
        group_of_data: ''
      }
    }
  },
  methods: {
    save() {
      axios({
        method: 'post',
        url: route('manager.evaluation.sections.questions.store', {evaluation: this.diagnose.id, section: this.diagnoseSection.id}),
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
