<template>
    <admin-layout>
        <template v-slot:head>
            <h1>{{ title }}</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <area-form
                  origin="discipline"
                  action="patch"
                  :content="discipline"
                  :route_action="route('manager.areas.disciplines.update', {area:area.id, discipline: discipline.id})"
                  :redirect_to="route('manager.areas.show', {id: area.id})"
              />
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import AreaForm from "@/Pages/Admin/Area/AreaForm";

export default {
  components: {
    AdminLayout,
    AreaForm
  },
  props: {
    title: {
      type: String
    },
    area: {
      type: Object
    },
    discipline: {
      type: Object
    }
  }
}
</script>

