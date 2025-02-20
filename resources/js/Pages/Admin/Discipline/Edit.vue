<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Tema</h1>
    </template>
    <template v-slot:content>
      <div class="w-full flex justify-center">
        <area-form
            :content="discipline"
            action="patch"
            :route_action="route('manager.disciplines.update', {id: discipline.id})"
            :redirect_to="route('manager.disciplines.index')"
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
    discipline: {
      type: Object
    }
  },
  data() {
    return {
      form: {
        name: '',
        main_image: '',
        secondary_image: '',
        is_active: 1,
      }
    }
  }
}
</script>
