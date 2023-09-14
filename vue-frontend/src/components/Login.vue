<template>
    <div class="container">
      <h1>Login</h1>
      <form @submit.prevent="authStore.login(form)">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email" v-model="form.email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Password" v-model="form.password" />
        </div>
  
        <button type="submit">Login</button>
      </form>
    </div>
  </template>

<script setup>
    import {ref} from 'vue'
    import { useAuthStore } from '../stores/auth';

    const authStore = useAuthStore()

    const form = ref({
        username: '',
        password: ''
    })

</script>

<style scoped>
</style>