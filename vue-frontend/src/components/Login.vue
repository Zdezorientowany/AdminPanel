<template>
  <div class="container">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Email" v-model="form.email" required/>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Password" v-model="form.password" required/>
      </div>
      
      <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>

      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '../stores/auth';

const authStore = useAuthStore();

const form = ref({
  email: '',
  password: ''
});

const errorMessage = ref('');

const login = async () => {
  try {
    await authStore.login(form.value);
  } catch (error) {
    if (error.response && error.response.status === 422) {
      errorMessage.value = 'Invalid email or password. Please try again.';
    } else {
      errorMessage.value = 'An error occurred. Please try again later.';
    }
  }
};
</script>
