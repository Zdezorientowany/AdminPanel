<template>

    <Nav />
    <RouterView />

</template>

<script setup>
  import { RouterView } from 'vue-router';
  import Nav from './components/Nav.vue';
  import { onMounted} from 'vue'

  import {useAuthStore} from './stores/auth'
  const authStore = useAuthStore()

  onMounted(async () => {
    await authStore.getUser()
  })

</script>

<style scoped>

</style>
