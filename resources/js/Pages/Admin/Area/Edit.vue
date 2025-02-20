<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Editar</h1>
    </template>
    <template v-slot:content>
      <div class="w-full flex justify-center">
        <area-form
            :content="area"
            action="patch"
            :route_action="route('manager.areas.update', {id: area.id})"
            :redirect_to="route('manager.areas.index')"
            origin="area"
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
    area: Object
  },
}
</script>
