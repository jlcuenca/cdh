<template>
  <page-layout>
    <template v-slot:section>
      <h1>Empleado</h1>
    </template>
    <template v-slot:content>
      <div class="max-w-xl mx-auto">
        <div class="w-full flex justify-center bg-white p-6 rounded-lg shadow">
          <employee-form
              action="update"
              :route_action="route('webapp.employees.update', {employee: employee.id})"
              :redirect_to="route('webapp.company.index')"
              :employee="employee"
          />
        </div>
      </div>
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";
import EmployeeForm from "@/Pages/Shared/EmployeeForm";

export default {
  components: {
    PageLayout,
    EmployeeForm
  },
  props: {
    employee: {
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