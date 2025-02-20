<template>
  <page-layout>
    <template v-slot:section>
      <h1>Mi perfil</h1>
    </template>
    <template v-slot:content>
      <profile :user="user" :route-url="route('webapp.profile.update', {id: user.id})"/>
    </template>
  </page-layout>
</template>

<script>
import PageLayout from "@/Layouts/PageLayout";
import Profile from "@/Pages/Shared/Profile";

export default {
  components: {
    PageLayout,
    Profile
  },
  props: {
    user: {
      type: Object
    }
  }
}
</script>
