<template>
    <div class="container">
        <h1>Edit Content by id: {{ content.id }} </h1>
        <form @submit.prevent="EditContent()">
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

        <button type="submit">Edit</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        emits: ['editContent'],
        props: ['content'],
        data() {
            return {
                tempTags: '',
                form: {
                    title: '',
                    content: '',
                    publish_date: '',
                    tags: []
                },
            };
        },
        mounted() {
                console.log('edit content:', this.content)
                this.form = this.content;
            },
        methods: {
            async EditContent() {
                console.log('create content:', this.form);
                const data = await axios.put(`/api/content/${this.content.id}`, this.form);
                this.$emit('editContent', data.data);
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