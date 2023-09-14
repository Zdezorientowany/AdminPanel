<template>
    <div class="container">
      <h1>Create User</h1>
      <form @submit.prevent="CreateUser()">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" placeholder="Name" v-model="form.name" required/>
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <select id="role" v-model="form.role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email" v-model="form.email" required/>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Password" v-model="form.password" required/>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Password Confirmation</label>
          <input type="password" id="password_confirmation" placeholder="Password" v-model="form.password_confirmation" required/>
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>
  
        <button type="submit">Add User</button>
      </form>
    </div>
  </template>

<script>
import axios from 'axios';

export default {
  emits: ['addUser'],
  data() {
    return {
      form: {
        name: '',
        role: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      error: null,
    };
  },
  methods: {
    async CreateUser() {
      try {
        const response = await axios.post('/api/user/create', this.form);
        this.$emit('addUser', response.data);
        this.error = null;
      } catch (error) {
        this.error = 'Error: '+ error.response.data.message+'. Please try again.';
      }
    },
  },
};
</script>

<style scoped>

</style>
