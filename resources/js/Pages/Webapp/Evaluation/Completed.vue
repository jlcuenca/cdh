<template>
  <page-layout>
    <template v-slot:section>
      {{ evaluation.title }}
    </template>
    <template v-slot:content>

      <div class="max-w-2xl mx-auto">
        <div v-for="(section, index) in sections" class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                #{{ index + 1 }}  {{ section.title }}
              </h3>
              <p class="mt-1 max-w-2xl  text-gray-500">
                {{ section.excerpt }}
              </p>
            </div>
            <div class="border-t border-gray-200">
              <dl>
                <div class="bg-indigo-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class=" font-medium text-gray-500 uppercase">
                    Pregunta
                  </dt>
                  <dd class="mt-1  text-gray-900 sm:mt-0 sm:col-span-2 uppercase">
                    Tu respuesta
                  </dd>
                </div>
                <div v-for="question in section.questions" class="bg-wihte px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                  <dt class=" font-medium text-gray-500">
                    <p>{{ question.title }}</p>
                    <p>{{ question.description }}</p>
                  </dt>
                  <dd class="mt-1  text-gray-900 sm:mt-0 sm:col-span-2">
                    <template v-for="answer in question.user_answers">
                      {{ answer.answer.content }}
                    </template>
                  </dd>
                </div>
              </dl>
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
    sections: {
      type: Object
    },
  },
  data() {
    return {
      selected: ''
    }
  },
  methods: {
    calculateProgress(questions_count, answers_count) {
      let style;

      if (questions_count === 0) {
        style = 'width: 0%;'
      } else {
        let w = answers_count * 100 / questions_count;
        style = `width: ${w}%;`
      }

      return style;
    }
  },
  mounted() {}
}
</script>
