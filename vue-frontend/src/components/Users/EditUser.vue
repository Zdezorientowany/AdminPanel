<template>
    <div class="container">
      <h1>Edit User by id: {{ user.id }}</h1>
      <form @submit.prevent="EditUser()">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" :placeholder="user.name" v-model="form.name" />
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" id="role" :placeholder="user.role" v-model="form.role" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" :placeholder="user.email" v-model="form.email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Password" v-model="form.password" />
        </div>
        <div class="form-group">
          <label for="password_confirmation">Password Confirmation</label>
          <input
            type="password"
            id="password_confirmation"
            placeholder="Password"
            v-model="form.password_confirmation"
          />
        </div>
  
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
            };
        },
        mounted() {
                console.log('edit content:', this.content)
                this.form = this.user;
            },
        methods: {
            async EditUser() {
            console.log('edit user:', this.form);
            const data = await axios.put(`/api/users/${this.user.id}`, this.form);
            this.$emit('editUser', this.form);
            },
        },
    };

    
</script>

<style scoped>

</style>
```