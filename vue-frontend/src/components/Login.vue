<template>
    <h1>Login</h1>
    <form @submit.prevent="authStore.login(form)">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Email" v-model="form.email"/>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Password" v-model="form.password"/>
        </div>

      <button type="submit">Login</button>
    </form>
</template>

<script setup>
    import {ref} from 'vue'
    import { useAuthStore } from '../stores/auth';

    const authStore = useAuthStore()

    const form = ref({
        username: '',
        password: ''
    })


    const onLogin = async () => {

        await authStore.login(form.value)
    }

</script>

<style scoped>
</style>