<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Cursos</h1>
            <Link :href="`${route('manager.courses.create')}`"
                          class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </Link>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th v-for="item in table_head.wellness" :class="item.class">{{ item.name }}</th>
                </template>
              <template v-slot:tbody>
                  <tr-wellness :records="records.data"></tr-wellness>
              </template>
            </table-component>

          <div class="mt-5">
            <div v-html="pagination"></div>
          </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";
import TrWellness from "@/Components/TrWellness";
import TrTraining from "@/Components/TrTraining";
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: {
    AdminLayout,
    TableComponent,
    TrWellness,
    TrTraining,
      Link,
  },
  props: {
    records: {
      type: String
    },
    pagination: {
      type: String
    },
    category: {
      type: String
    }
  },
  data() {
    return {
      table_head: {
        wellness: [
          {'name': 'Titulo', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Lecciones', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Cursantes', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Estado', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name':'', 'class':''}
        ],
        training: [
          {'name': 'Titulo', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Tema', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Lecciones', 'class': 'px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name': 'Estado', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
          {'name':'', 'class':''},
          {'name':'', 'class':''}
        ]
      }
    }
  }
}
</script>
