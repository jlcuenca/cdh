<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Inicio</h1>
        </template>
        <template v-slot:content>
            <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                <card-indicator title="Total de usuarios" :value="usersCount">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users w-8 h-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                </card-indicator>

                <card-indicator title="Cursamientos finalizados" :value="usersWithCoursesCompletedCount">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-medal w-8 h-8"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 4v3m-4 -3v6m8 -6v6"></path>
                        <path d="M12 18.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5z"></path>
                    </svg>
                </card-indicator>

                <card-indicator title="En aprendizaje" :value="usersWithCoursesInProgressCount">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook w-8 h-8" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18"></path>
                        <line x1="13" y1="8" x2="15" y2="8"></line>
                        <line x1="13" y1="12" x2="15" y2="12"></line>
                    </svg>
                </card-indicator>

                <card-indicator title="Total cursos" :value="coursesCount">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book w-8 h-8"  viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                        <line x1="3" y1="6" x2="3" y2="19"></line>
                        <line x1="12" y1="6" x2="12" y2="19"></line>
                        <line x1="21" y1="6" x2="21" y2="19"></line>
                    </svg>
                </card-indicator>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="bg-white rounded-xl p-2 shadow">
                    <graph-bar title="Cursos con más suscripciones" serie-name="Cursantes" :content="graph.courses_content" :colors="['#365cf4']" />
                </div>
                <div class="bg-white rounded-xl p-2 shadow">
                    <graph-bar title="Suscriptores con más cursos" serie-name="Cursos" :content="graph.students_content" :colors="['#9C27B0']"/>
                </div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout";
import GraphBar from "@/Components/GraphBar";
import CardIndicator from "@/Components/CardIndicatorComponent";

export default {
    name: "Dashboard",
    components: {
        AdminLayout,
        GraphBar,
        CardIndicator,
        Link
    },
    props: [
        'coursesCount',
        'topTenCourses',
        'usersCount',
        'usersWithCoursesCompletedCount',
        'usersWithCoursesInProgressCount',
        'topTenUsers',
    ],
    data() {
      return {
          graph: {
              courses_content: null,
              students_content: null,
          }
      }
    },
    methods: {
        parseContentToGraph() {
            this.graph.courses_content = this.topTenCourses.map((record) => {
                return {
                    category: record.title,
                    value: record.users_count
                };
            });
            this.graph.students_content = this.topTenUsers.map((record) => {
                return {
                    category: record.name,
                    value: record.courses_count
                };
            });
        }
    },
    created() {
        this.parseContentToGraph();
    }
}
</script>

