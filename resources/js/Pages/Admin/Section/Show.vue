<template>
    <admin-layout>
      <div class="text-xl font-bold grid grid-cols-1">
        <a :href="route('manager.evaluation.sections.index', {id: diagnose.id})" class="text-gray-500 hover:text-maroon-500">Evaluación: {{ diagnose.title }}</a>
        <a :href="route('manager.evaluation.sections.index', {id: diagnose.id})" class="text-gray-500 hover:text-maroon-500">Sección: {{ diagnoseSection.title }}</a>
      </div>
      <div class="pb-4 border-b border-gray-300 text-xl font-bold flex justify-between items-center">
        <div>
          <h1 class="text-gray-500">Preguntas</h1>
          <p class=" font-normal text-gray-600">
            Las secciones representan a un conjunto de preguntas.
          </p>
        </div>
        <Link :href="route('manager.evaluation.sections.questions.create', {evaluation: diagnose.id, section:diagnoseSection.id})" class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" data-v-2ea5b8b2=""><path stroke="none" d="M0 0h24v24H0z" fill="none" data-v-2ea5b8b2=""></path><line x1="12" y1="5" x2="12" y2="19" data-v-2ea5b8b2=""></line><line x1="5" y1="12" x2="19" y2="12" data-v-2ea5b8b2=""></line></svg>
        </Link>
      </div>

      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Título
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Descripción
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Respuestas
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <tr v-for="record in records">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class=" font-medium text-gray-900">
                          {{ record.title }}
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class=" text-gray-500 overflow-ellipsis overflow-hidden" style="width: 200px;">
                        {{ record.description }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="grid grid-cols-3 gap-2">
                        <span v-for="answer in record.answers" class="bg-gray-100  text-gray-500 border rounded-full px-2 text-center">
                          {{ answer.content }}
                        </span>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right  font-medium">
                      <a :href="route('manager.evaluation.sections.questions.edit', {evaluation: record.diagnose_id, section: record.diagnose_section_id, question: record.id})" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/ManagerLayout";

export default {
  components: {AdminLayout},
  props: {
    diagnose: {
      type: Object
    },
    diagnoseSection: {
      type: Object
    },
    records: {
      type: Object
    }
  }
}
</script>
