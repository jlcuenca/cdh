<template>
    <page-layout>
        <template v-slot:section>
          <div class="text-center">
            <p class="block">{{ evaluation.title }}</p>
            <p class="block text-lg">{{ section.title }}</p>
          </div>
        </template>
        <template v-slot:content>
            <div class="max-w-3xl mx-auto">
              <div class="flex items-center justify-center" v-if="loaded">
                <div class="flex flex-col w-full bg-white rounded shadow-lg">
                  <div class="flex flex-col w-full md:flex-row">
                    <div v-for="question in content.data" class="font-normal text-gray-800 w-full">
                      <div class="p-6">
                        <h1 class="mb-4 text-lg font-bold leading-none tracking-tight text-gray-800">
                          {{ question.title }}
                        </h1>
                        <p class="leading-normal">{{ question.description}}</p>

                        <div class="flex flex-row items-center mt-4 text-gray-700 w-full">

                          <template v-if="question.answers_type !== ''">
                            <div :class="question.answers_type === 'group_of_data' ? 'sm:grid-cols-5 gap-x-2 gap-y-4': 'sm:grid-cols-2 gap-x-6 gap-y-4'" class="grid grid-cols-1 w-full">
                              <template  v-for="(answer, index) in question.answers">
                                <label :for="`${index}-qa`" :class="answer.id === selected ? 'bg-maroon-500 text-white border-maroon-200 border-2' : 'bg-gray-100'" class="w-full rounded-full px-4 py-1 hover:bg-maroon-500 hover:text-white cursor-pointer text-center">
                                  {{ answer.content }}
                                </label>
                                <input type="radio" :id="`${index}-qa`" class="hidden" :value="answer.id" v-model="selected" />
                              </template>
                            </div>
                          </template>
                        </div>
                      </div>
                      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="button" @click="nextHandler" :class="selected !== '' ? 'text-white bg-indigo-600 hover:bg-indigo-700': 'text-indigo-300 border border-indigo-300'" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm  font-medium rounded-full  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                          Siguiente
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </template>
    </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";

export default {
  components: {PageLayout},
  props: {
    evaluation: {
      type: Object
    },
    section: {
      type: Object
    },
    questions: {
      type: Object
    },
  },
  data() {
    return {
      selected: '',
      url: route('webapp.api.evaluation.section.questions.index', {evaluation: this.evaluation.id, section: this.section.id}),
      loaded: false,
      content: null,
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
    }
  },
  methods: {
    nextHandler() {
      if (this.selected === '') {
        return;
      }
      const next = this.content.next_page_url;
      const evaluation_route = route('webapp.evaluation.show', {id: this.evaluation.id});

      axios.post(this.content.path, {
        question: this.content.data[0].id,
        answer: this.selected
      }).then(({ data }) => {

        if (next === null) {
          window.location.replace(evaluation_route);
        } else {
          this.cursor(next);
        }
      }).catch(err => {
        console.error(err)
      });

    },
    cursor(url) {
      this.loaded = false;
      axios.get(url).then(({ data }) => {
        this.content = data;
      }).finally(() => {
        this.loaded = true;
      });
    }
  },
  mounted() {
    this.cursor(this.url)
  }
}
</script>
