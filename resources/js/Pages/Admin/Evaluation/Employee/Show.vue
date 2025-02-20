<template>
  <admin-layout>
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
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/ManagerLayout";
import EmployeeForm from "@/Pages/Shared/EmployeeForm";

export default {
  components: {
    AdminLayout,
    EmployeeForm
  },
  props: {
    company: {
      type: Object
    },
    employee: {
      type: Object
    },
    sections: {
      type: Object
    }
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: null,
        active: 1
      }
    }
  },
  mounted() {
    this.form = {
      name: this.employee.name,
      email: this.employee.email,
      password: '',
      active: this.employee.is_active
    }
  }
}
</script>
