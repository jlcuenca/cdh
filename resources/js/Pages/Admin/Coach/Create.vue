<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Información de cursante</h1>
    </template>
    <template v-slot:content>
      <div class="w-full">
        <coach-form
            :content="form"
            :route_action="route('manager.coaches.store')"
            :redirect_to="route('manager.coaches.index')"
            action="post"
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
    data() {
        return {
            form: {
                email: '',
                password: null,
                is_active: 1,
                firstname: '',
                paternal_lastname: '',
                maternal_lastname: '',
                gender: '',
                state_name: 'morelos',
                city_name: null,
                address: '',
                date_of_birth: '',
                postal_code: '',
                phone: '',
            }
        }
    }
}
</script>
