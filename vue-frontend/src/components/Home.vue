<template>
    <h1>Home</h1>
    
</template>

<script setup>
    import { onMounted} from 'vue'
    import {useAuthStore} from '../stores/auth'
    const authStore = useAuthStore()

    onMounted(async () => {
        await authStore.getUser()
    })

</script>

<style scoped>
</style>
```