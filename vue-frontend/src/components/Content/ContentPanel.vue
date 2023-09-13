<template>
      <div v-if="isAddFormShowed">

  </div>
  <div v-if="isEditFormShowed">

  </div>
  <div>
    <table class="table">
      <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>publish_date</th>
            <th>created_at</th>
            <th>Tags</th>
            <th>Actions <button @click="addContent()" :disabled="isEditFormShowed">Add Content</button></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="content in contents" :key="content.id">
            <td>{{ content.id }}</td>
            <td>{{ content.title }}</td>
            <td>{{ content.content }}</td>
            <td>{{ content.publish_date }}</td>
            <td>{{ content.created_at }}</td>
            <td>{{ content.tags }}</td>
            <td>
            <button @click="editContent(content)" :disabled="isAddFormShowed">Edit</button>
            <button @click="deleteContent(content)">Delete</button>
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

    let isAddFormShowed = ref(false)
    let isEditFormShowed = ref(false)

    // const authStore = useAuthStore()

    const contents = ref([])
    let userToEdit = ref(null)

    onMounted(async () => {
        const response = await axios.get('/api/contents');
        contents.value = response.data;
    })

    function addContent() {
        isAddFormShowed.value = true
    }

    function editContent(content) {
        isEditFormShowed.value = true
        userToEdit.value = content
    }

    function deleteContent(content) {
        axios.delete(`/api/contents/${content.id}`)
        contents.value.splice(contents.value.indexOf(content), 1)
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