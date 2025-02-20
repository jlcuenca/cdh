<template>
    <page-layout>
        <template v-slot:section>
          {{ evaluation.title }}
        </template>
        <template v-slot:content>
            <div class="px-0 md:px-20 space-y-4">
              <div class="font-sans flex items-center justify-center  w-full py-8">
                <div class="overflow-hidden bg-white rounded max-w-xs w-full shadow-lg  leading-normal">
                  <a v-for="section in sections" :href="route('webapp.evaluation.section.show', {'evaluation':evaluation.id, 'section':section.id})" class="block group hover:bg-gray-50  p-4 border-b">
                    <div class="font-bold text-lg mb-1 text-black">
                      <div>{{ section.title }}</div>
                    </div>
                    <p class="text-grey-darker mb-2">{{ section.excerpt }}</p>
                    <div class=" text-maroon-300">{{ section.questions_count }} preguntas</div>
                    <div class="mt-4 mb-2">
                      <div class="bg-gray-200 w-full rounded-full" style="height: 10px">
                        <div class="h-full rounded-full bg-green-500" :style="calculateProgress(section.questions_count, section.users_answers_count)"></div>
                      </div>
                    </div>
                  </a>
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
