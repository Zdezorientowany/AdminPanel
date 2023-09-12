<template>
    <div class="navbar">
      <router-link :to="{ name: 'Home' }" class="nav-button home-button">Home</router-link>
      <template v-if="!authStore.user">
        <p>You're Loggout</p>
        <router-link :to="{ name: 'Login' }" class="nav-button login-button">Login</router-link>
      </template>
      <template v-else>
        <p>Welcome: {{authStore.user.name}}</p>
        <button @click="authStore.logout" class="nav-button login-button">Logout</button>
      </template>
      
    </div>
  </template>
  
  <script setup>
    import {useAuthStore} from '../stores/auth'

    const authStore = useAuthStore()

  </script>
  
  <style>
  .navbar {
    background-color: #662549; /* Set the background color */
    border-radius: 0 0 15px 15px; /* Rounded bottom corners */
    display: flex;
    justify-content: space-between; /* Push the buttons to the corners */
    padding: 10px;
  }
  
  .nav-button {
    padding: 10px 20px; /* Add padding to create a button-like appearance */
    color: white;
    text-decoration: none;
    border-radius: 5px; /* Rounded corners for the buttons */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
  
  }
  
  .home-button {
    background-color: #451952; /* Button color for Home */
  }
  
  .login-button {
    background-color: #AE445A; /* Button color for Login */
  }
  
  /* Hover effect */
  .nav-button:hover {
    background-color: #F39F5A;
  }
  </style>
  