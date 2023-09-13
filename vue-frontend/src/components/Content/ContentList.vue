<template>
    <div class="content-list">
        <div class="content-item" v-for="content in contents" :key="content.id">
        <h2>{{ content.title }}</h2>
        <div>{{ content.content }}</div>
        <p>published: {{ content.publish_date }}</p>
        <div class="tags">
            Tags: <span v-for="tag in content.tags" :key="tag.id">{{ tag.name }}</span>
        </div>
        </div>
    </div>
</template>
  
<script>
    import { ref } from 'vue';
    import axios from 'axios';

  export default {
    data() {
        return {
            contents: ref([]),
        };
    },
    async mounted() {
        const response = await axios.get('/api/contents');
        this.contents = response.data;
    },
  };
</script>
  
<style scoped>
    /* Style the content list */
    .content-list {
    overflow-y: scroll;
    max-height: 100%; /* Adjust the maximum height as needed */
    margin-top: 20px;
    }

    /* Style each content item */
    .content-item {
    margin: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #662549;
    font-size: 16px;
    }

    /* Style the content text */
    .content-text {
    margin-top: 10px;
    }

    /* Style tags */
    .tags {
    margin-top: 10px;
    }

    /* Style action buttons */
    .edit-button,
    .delete-button {
    padding: 6px 12px;
    margin-right: 5px;
    cursor: pointer;
    background-color: #AE445A; /* Dark pink */
    color: #fff; /* White text on dark pink */
    border: none;
    border-radius: 4px;
    }

    .edit-button:hover,
    .delete-button:hover {
    background-color: #F39F5A; /* Orange */
    }
</style>
