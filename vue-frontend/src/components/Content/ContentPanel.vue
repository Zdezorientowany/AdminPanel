<template>
    <div v-if="isAddFormShowed">
        <CreateContent @addContent="UpdateContents"/>
    </div>

    <div v-if="isEditFormShowed">
        <EditContent :content="contentToEdit" @editContent="UpdateContents"/>
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
        <tr v-for="content in paginatedContents" :key="content.id">
                <td>{{ content.id }}</td>
                <td>{{ content.title }}</td>
                <td>{{ content.content }}</td>
                <td>{{ content.publish_date }}</td>
                <td>{{ content.created_at }}</td>
                <td>
                <span v-for="tag in content.tags" :key="tag.id" class="tags_layout">{{ tag}}</span>  
                </td>
                <td>
                <button @click="editContent(content)" :disabled="isAddFormShowed">Edit</button>
                <button @click="deleteContent(content)">Delete</button>
            </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination controls -->
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>

  </div>
</template>
  
<script setup>
    import axios from 'axios';
    import { ref, onMounted, computed } from 'vue';
    import CreateContent from './CreateContent.vue'
    import EditContent from './EditContent.vue'

    let isAddFormShowed = ref(false)
    let isEditFormShowed = ref(false)

    const contents = ref([])
    let contentToEdit = ref(null)
    const perPage = ref(10); // Number of items per page
    let currentPage = ref(1);

    onMounted(async () => {
        const response = await axios.get('/api/contents');
        contents.value = response.data;
        contents.value.forEach(content => {
            content.tags = content.tags.map(tag => tag.name)
        })
    })

    const paginatedContents = computed(() => {
        const startIndex = (currentPage.value - 1) * perPage.value;
        const endIndex = startIndex + perPage.value;
        return contents.value.slice(startIndex, endIndex);
    });

    const totalPages = computed(() => Math.ceil(contents.value.length / perPage.value));

    const prevPage = () => {
        if (currentPage.value > 1) {
            currentPage.value -= 1;
        }
    };

    const nextPage = () => {
        if (currentPage.value < totalPages.value) {
            currentPage.value += 1;
        }
    };

    function addContent() {
        isAddFormShowed.value = true
    }

    function editContent(content) {
        isEditFormShowed.value = true
        contentToEdit.value = content
    }

    function deleteContent(content) {
        axios.delete(`/api/contents/${content.id}`)
        contents.value.splice(contents.value.indexOf(content), 1)
    }

    function UpdateContents(content) {
        if(isAddFormShowed.value){
            isAddFormShowed.value = false
            content.tags = content.tags.map(tag => tag.name)
            contents.value.push(content);

        }
        if(isEditFormShowed.value){
            isEditFormShowed.value = false
            contents.value[contentToEdit.value.id - 1].title = content.title
            contents.value[contentToEdit.value.id - 1].content = content.content
            contents.value[contentToEdit.value.id - 1].publish_date = content.publish_date
            contents.value[contentToEdit.value.id - 1].tags = content.tags.map(tag => tag.name)
        }
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