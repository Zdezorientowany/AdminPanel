<template>
  <div class="navbar">
    <router-link :to="{ name: 'Home' }" class="nav-button home-button">Home</router-link>

    <template v-if="!authStore.user"> <!-- Show if user is not logged in -->
      <span class="login-text">You're Logged Out</span>
      <router-link :to="{ name: 'Login' }" class="nav-button login-button">
        Log In
      </router-link>
    </template>

    <template v-else> <!-- Show if user is logged in -->
      <template v-if="authStore.user.role === 'admin'"> 
        <router-link :to="{ name: 'USERPANEL' }" class="nav-button user-panel-button">
          User Panel
        </router-link>
        <router-link :to="{ name: 'CONTENTPANEL' }" class="nav-button user-panel-button">
          Content Panel
        </router-link>
      </template>
      <span class="welcome-text">Welcome: {{ authStore.user.name }}</span>
      <button @click="authStore.logout" class="nav-button login-button">
        <span>Logout</span>
      </button>
    </template>
  </div>
</template>

<script setup>
import { useAuthStore } from '../stores/auth'

const authStore = useAuthStore()
</script>

<style>
.navbar {
  background-color: #662549;
  border-radius: 0 0 15px 15px;
  display: flex;
  align-items: center;
  padding: 10px;
}

.nav-button {
  padding: 10px 20px;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.home-button,
.user-panel-button,
.logout-button {
  margin-right: 10px;
}

.home-button {
  background-color: #451952;
}

.login-button {
  background-color: #AE445A;
  margin-right: 0;
}

.nav-button:hover {
  background-color: #F39F5A;
}

.login-text,
.logout-text,
.welcome-text {
  padding: 5px 10px;
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: 5px;
  margin-right: 5px;
}

.logout-text {
  margin-left: -5px;
}
</style>