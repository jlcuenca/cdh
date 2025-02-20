<template>
    <admin-layout>
        <template v-slot:head>
            <h1>Empleado</h1>
        </template>
        <template v-slot:content>
            <div class="w-full flex justify-center">
              <employee-form
                  :route_action="route('manager.companies.employees.store', {id: company.id})"
                  :redirect_to="route('manager.companies.show', {id: company.id})"
                  :employee="form"
              />
            </div>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import EmployeeForm from "@/Pages/Shared/EmployeeForm";

export default {
  components: {
    AdminLayout,
    EmployeeForm
  },
  props: {
    company: {
      type: Object
    },
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        active: 1
      }
    }
  }
}
</script>