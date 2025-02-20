<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Usuario</h1>
    </template>
    <template v-slot:content>
      <div class="w-full">
        <coach-form
            :content="coach"
            :route_action="route('manager.coaches.update', {id: coach.id})"
            :redirect_to="route('manager.coaches.show', {id: coach.id})"
            action="patch"
        />
      </div>
    </template>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import CoachForm from "@/Pages/Admin/Coach/CoachForm";

export default {
  components: {
    AdminLayout,
    CoachForm
  },
  props: {
    coach: {
      type: Object
    }
  }
}
</script>
