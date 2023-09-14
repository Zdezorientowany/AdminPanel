<template>
    <div class="container">
      <h1>Create User</h1>
      <form @submit.prevent="CreateUser()">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" placeholder="Name" v-model="form.name" />
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" id="role" placeholder="Role" v-model="form.role" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Email" v-model="form.email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Password" v-model="form.password"/>
        </div>
        <div class="form-group">
          <label for="password_confirmation">Password Confirmation</label>
          <input type="password" id="password_confirmation" placeholder="Password" v-model="form.password_confirmation"/>
        </div>
  
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
            };
        },
        methods: {
            async CreateUser() {
            console.log('create user:', this.form);
            const data = await axios.post('/api/user/create', this.form);
            this.$emit('addUser', data.data);
            },
        },
    };
</script>

<style scoped>

</style>
