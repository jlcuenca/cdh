<template>
  <layout>
    <template v-slot:section>
      <h1>{{evaluation.title  }}</h1>
    </template>
    <template v-slot:content>
      <div class="max-w-2xl mx-auto">
        <div class="font-bold mb-4">
          {{ employee.name }}
        </div>
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
                <dt class=" font-medium text-gray-500 uppercase sm:col-span-2">
                  Pregunta
                </dt>
                <dd class="mt-1  text-gray-900 sm:mt-0 uppercase">
                  Respuesta
                </dd>
              </div>
              <div v-for="question in section.questions" class="bg-wihte px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class=" font-medium text-gray-500 sm:col-span-2">
                  <p>{{ question.title }}</p>
                  <p>{{ question.description }}</p>
                </dt>
                <dd class="mt-1  text-gray-900 sm:mt-0">
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
  </layout>
</template>

<script>
import Layout from "@/Layouts/PageLayout";
import EmployeeForm from "@/Pages/Shared/EmployeeForm";

export default {
  components: {
    Layout,
    EmployeeForm
  },
  props: {
    evaluation: {
      type: Object
    },
    employee: {
      type: Object
    },
    sections: {
      type: Object
    }
  }
}
</script>
