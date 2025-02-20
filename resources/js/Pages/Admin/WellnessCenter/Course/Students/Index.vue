<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Curso: {{ course.title }}</h1>
            <Link :href="`${route('manager.courses.index')}`"
                          class="rounded-full h-12 w-12 shadow bg-blue-500 text-white hover:bg-blue-600 transition duration-100 flex items-center justify-center content-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <line x1="5" y1="12" x2="11" y2="18"></line>
                    <line x1="5" y1="12" x2="11" y2="6"></line>
                </svg>
            </Link>
        </template>
        <template v-slot:content>
            <table-component>
                <template v-slot:thead>
                    <th v-for="item in tableHader" :class="item.class">{{ item.name }}</th>
                </template>
                <template v-slot:tbody>

                    <tr v-for="record in records.data">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            <div class="flex items-center">
                                <div class="">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ record.name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ record.email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap  text-gray-900 text-left">
                            {{ record.progress.filter(item => item.completed).length }} / {{ lessonsCount }}
                        </td>
                    </tr>

                </template>
            </table-component>

            <div class="mt-5">
                <div v-html="pagination"></div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import AdminLayout from "@/Layouts/AdminLayout";
import TableComponent from "@/Components/TableComponent";

export default {
  components: {
      AdminLayout,
      Link,
      TableComponent,
  },
  props: {
      course: {
          type: Object
      },
      records: {
          type: Object
      },
      pagination: {
          type: String
      },
      lessonsCount: {
          type: Number
      },
  },
  data() {
    return {
        tableHader: [
            {'name': 'Cursante', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
            {'name': 'Lecciones', 'class': 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider'},
        ],
    }
  }
}
</script>
