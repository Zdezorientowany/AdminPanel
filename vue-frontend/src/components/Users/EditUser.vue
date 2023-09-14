<template>
    <div class="container">
      <h1>Edit User by id: {{ user.id }}</h1>
      <form @submit.prevent="EditUser()">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" :placeholder="user.name" v-model="form.name" required/>
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
          <input type="email" id="email" :placeholder="user.email" v-model="form.email" required/>
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
  
        <button type="submit">Edit User</button>
      </form>
    </div>
  </template>
  

<script>
    import axios from 'axios';

    export default {
        emits: ['editUser'],
        props: ['user'],
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
        mounted() {
                console.log('edit content:', this.content)
                this.form = this.user;
            },
        methods: {
            async EditUser() {
              try {
                await axios.put(`/api/users/${this.user.id}`, this.form);
                this.$emit('editUser', this.form);
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
```