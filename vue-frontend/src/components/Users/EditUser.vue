<template>
    <h1>Edit User by id: {{ user.id }}</h1>
        <form @submit.prevent="EditUser()">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" :placeholder="user.name" v-model="form.name"/>
            </div>
            <div>
                <label for="role">Role</label>
                <input type="text" id="role" :placeholder="user.role" v-model="form.role"/>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" :placeholder="user.email" v-model="form.email"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="password" v-model="form.password"/>
            </div>
            <div>
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" id="password_confirmation" placeholder="password" v-model="form.password_confirmation"/>
            </div>

        <button type="submit">Edit User</button>
        </form>
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