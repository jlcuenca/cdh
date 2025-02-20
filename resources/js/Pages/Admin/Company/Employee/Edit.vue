<template>
  <admin-layout>
    <template v-slot:head>
      <h1>Empleado</h1>
    </template>
    <template v-slot:content>
      <div class="w-full flex justify-center">
        <employee-form
            action="update"
            :route_action="route('manager.companies.employees.update', {employee: employee.id, company: company.id})"
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
    employee: {
      type: Object
    },
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: null,
        active: 1
      }
    }
  },
  mounted() {
    this.form = {
      name: this.employee.name,
      email: this.employee.email,
      password: '',
      active: this.employee.is_active
    }
  }
}
</script>