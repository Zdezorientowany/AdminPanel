<template>
    <h1>Login</h1>
    <form @submit.prevent="onLogin">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Email" v-model="form.email"/>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" v-model="form.password"/>
        </div>

      <button type="submit">Login</button>
    </form>
</template>

<script setup>
    import {ref} from 'vue'
    import axios from 'axios'
    import {useRouter} from 'vue-router'

    const router = useRouter()
    const form = ref({
        username: '',
        password: ''
    })

    const onLogin = async () => {
        const data = await axios.post('/login', {
            email: form.value.email,
            password: form.value.password
        })
        console.log(data)
        router.push('/')
    }

</script>

<style scoped>
</style>