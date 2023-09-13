<template>
  <div v-if="isAddFormShowed">
    <CreateUser @addUser="UpdateUsers"/>
  </div>
  <div v-if="isEditFormShowed">
    <EditUser @editUser="UpdateUsers" v-bind:user="userToEdit" />
  </div>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Role</th>
          <th>Name</th>
          <th>Email</th>
          <th>Email Verified</th>
          <th>Created At</th>
          <th>Actions <button @click="addUser()" :disabled="isEditFormShowed">Add User</button></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.role }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.email_verified_at ? 'Yes' : 'No' }}</td>
          <td>{{ user.created_at }}</td>
          <td>
            <button @click="editUser(user)" :disabled="isAddFormShowed">Edit</button>
            <button @click="deleteUser(user)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
  import axios from 'axios';
  import { ref, onMounted } from 'vue';
  import { useAuthStore } from '../../stores/auth';
  import CreateUser from './CreateUser.vue'
  import EditUser from './EditUser.vue'
  
  let isAddFormShowed = ref(false)
  let isEditFormShowed = ref(false)

  const authStore = useAuthStore()

  const users = ref([])
  let userToEdit = ref(null)

  onMounted(async () => {
    await authStore.getUser()
    //get users from API
    const response = await axios.get('/api/users');
    users.value = response.data;
  })

  const addUser = () => {
    console.log('add user')
    isAddFormShowed.value = true
    
  }

  const UpdateUsers = (userData) => {
    console.log('update users')
    if(isAddFormShowed.value){
      console.log('user was added', userData)
      isAddFormShowed.value = false
      users.value.push(userData);
    }
    if(isEditFormShowed.value){
      console.log('user was edited', userData)
      isEditFormShowed.value = false

      //update user in users array
      users.value[userToEdit.id-1].name = userData.name
      users.value[userToEdit.id-1].role = userData.role
      users.value[userToEdit.id-1].email = userData.email
      
    }
  }



  const editUser = (user) => {
    console.log('edit user', user)
    userToEdit = user
    isEditFormShowed.value = true
  }
  const deleteUser = async (user) => {
    await axios.delete(`/api/users/${user.id}`);
    users.value.splice(users.value.indexOf(user), 1);

    console.log('delete user', user)
  }


</script>
 
<style scoped>
  /* Style the table */
  .table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
  }

  /* Style table header */
  .table th {
    background-color: #451952; /* Dark purple */
    text-align: left;
    padding: 12px;
    color: #fff; /* White text on dark purple */
  }

  /* Style table rows */
  .table td {
    border: 1px solid #ddd;
    padding: 12px;
  }

  /* Style alternating rows for better readability */
  .table tr:nth-child(even) {
    background-color: #662549; /* Dark red */
  }

  /* Style action buttons */
  .table button {
    padding: 6px 12px;
    margin-right: 5px;
    cursor: pointer;
    background-color: #AE445A; /* Dark pink */
    color: #fff; /* White text on dark pink */
    border: none;
    border-radius: 4px;
  }

  .table button:hover {
    background-color: #F39F5A; /* Orange */
  }
</style>