<template>
    <page-layout>
        <template v-slot:section>
          Diagnósticos
        </template>
        <template v-slot:content>
            <div class="px-0 md:px-20 space-y-4">

                <select v-model="selected" @change="selectHandler" class="w-full rounded shadow p-4 border-none focus:border-maroon-600 focus:ring-maroon-600 transition duration-100">
                    <option value="">Elige</option>
                    <option v-for="evaluation in evaluations" :value="evaluation.id">
                      {{ evaluation.title }}
                    </option>
                </select>
                <div class="w-full rounded overflow-x-auto">
                    <div class="w-full flex justify-center h-12 bg-maroon-600 rounded items-center">
                        <h1 class="text-2xl text-white rounded">Resultados</h1>
                    </div>
                    <div class="w-full hidden md:block">
                        <table class="table-fixed w-full rounded font-bold">
                            <thead class="rounded">
                              <tr class="w-full px-12">
                                  <th class="py-2 text-left">Fecha</th>
                                  <th class="py-2 text-left">Nombre</th>
                                  <th class="py-2 text-left">Empresa</th>
                                  <th class="py-2 text-left">Estado</th>
                                  <th class="py-2 text-left" width="50"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="evaluation in userEvaluations"
                                  class="w-full px-12 border-b-2 border-dotted border-black">
                                <td class="py-2">
                                  {{ evaluation.created_at_human }}
                                </td>
                                <td class="py-2">
                                  {{ evaluation.diagnose.title }}
                                </td>
                                <td class="py-2">
                                  <template v-if="$page.props.auth.user_company">
                                    {{ $page.props.auth.user_company.name }}
                                  </template>
                                </td>
                                <td class="py-2"></td>
                                <th class="py-2">
                                  <a :href="route('webapp.evaluation.show', {id: evaluation.diagnose_id})">Ver</a>
                                </th>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="rounded w-full shadow grid grid-cols-2 font-bold block md:hidden mt-6">
                        <div class="bg-maroon-600 text-white rounded-l space-y-4">
                            <div class="p-2 border-b border-white">#</div>
                            <div class="p-2 border-b border-white">Id</div>
                            <div class="p-2 border-b border-white">Fecha</div>
                            <div class="p-2 border-b border-white">Empresa</div>
                            <div class="p-2 border-b border-white">Nombre</div>
                            <div class="p-2 border-b">Status</div>
                        </div>
                        <div class="bg-white text-black rounded-r space-y-4">
                            <div class="p-2 border-b border-maroon-600">-</div>
                            <div class="p-2 border-b border-maroon-600">-</div>
                            <div class="p-2 border-b border-maroon-600">-</div>
                            <div class="p-2 border-b border-maroon-600">-</div>
                            <div class="p-2 border-b border-maroon-600">-</div>
                            <div class="p-2 ">-</div>
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
    evaluations: {
      type: Object
    },
    userEvaluations: {
      type: Object
    }
  },
  data() {
    return {
      selected: ''
    }
  },
  methods: {
    selectHandler() {
      const r = route('webapp.evaluation.show', {evaluation: this.selected});
      location.replace(r);
    }
  }
}
</script>