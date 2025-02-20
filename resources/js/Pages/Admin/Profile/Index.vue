<template>
    <admin-layout>
        <template v-slot:content>
          <profile :user="user" :route-url="route('manager.profile.update', {id: user.id})"/>
        </template>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Profile from "@/Pages/Shared/Profile";

export default {
  components: {
    AdminLayout,
    Profile
  },
  props: {
    user: {
      type: Object
    }
  }
}
</script>