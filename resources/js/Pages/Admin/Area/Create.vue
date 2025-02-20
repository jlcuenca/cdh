<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Área</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <area-form
                  :content="form"
                  :route_action="route('manager.areas.store')"
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
  data() {
    return {
      form: {
        name: '',
        main_image: '',
        secondary_image: '',
        is_active: 1
      }
    }
  }
}
</script>

