<template>
    <h1>Home</h1>
    <ContentList v-if="authStore.user"/>
    
</template>

<script setup>
    import ContentList from './Content/ContentList.vue';
    import { useAuthStore } from '../stores/auth';

    const authStore = useAuthStore();


</script>

<style scoped>
</style>
```