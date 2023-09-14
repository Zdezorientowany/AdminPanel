<template>
    <div class="container">
      <h1>Create Content</h1>
      <form @submit.prevent="CreateContent()">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" placeholder="Title" v-model="form.title" />
        </div>
        <div class="form-group">
          <label for="content">Content</label>
          <textarea id="content" placeholder="Lorem Ipsum dolor..." rows="4" v-model="form.content"></textarea>
        </div>
        <div class="form-group">
          <label for="publishDate">Publish Date</label>
          <input type="date" id="publishDate" placeholder="Publish Date" v-model="form.publish_date"/>
        </div>
        <div class="form-group">
          <label for="tags">Tags (type tag then press ALT + COMMA)</label>
          <input type="text" v-model="tempTags" @keyup.alt="addTag" />
          <div v-for="tag in form.tags" :key="tag" class="tags_layout">
            <span @click="deleteTag(tag)">{{ tag }}</span>
          </div>
        </div>

        <div v-if="error" class="error-message">{{ error }}</div>
  
        <button type="submit">Add</button>
      </form>
    </div>
  </template>

<script>
    import axios from 'axios';

    export default {
        emits: ['addContent'],
        data() {
            return {
                tempTags: '',
                form: {
                    title: '',
                    content: '',
                    publish_date: '',
                    tags: []
                },
                error: null,
            };
        },
        methods: {
            async CreateContent() {
              try{
                const data = await axios.post('/api/content/create', this.form);
                this.$emit('addContent', data.data);
                this.error = null;
              }
              catch(error){
                    this.error = 'Error: '+ error.response.data.message+'. Please try again.';
              }

            },

            addTag(e) {
                if(e.key === ',' && this.tempTags){
                    if(!this.form.tags.includes(this.tempTags)){
                        this.form.tags.push(this.tempTags);
                    }
                    this.tempTags = '';
                }
            },
            deleteTag(tag) {
                this.form.tags = this.form.tags.filter(item => {
                    return item !== tag;
                });
            },
        },
    };
</script>

<style scoped>
    /* Background color for the entire form */
    body {
        background-color: #451952;
    }

</style>
