<template>
    <admin-layout>
        <template v-slot:head>
            <h1>{{ title }}</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <area-form
                  origin="discipline"
                  route-name=""
                  :content="form"
                  :route_action="route('manager.areas.disciplines.store', {id: area.id})"
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
  },
  created() {
    this.form['area_id'] = this.area.id;
  }
}
</script>

