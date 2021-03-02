<template>
    <div class="projectEditor">

        <div v-if="this.project">
            <strong>Project – {{ this.project.name }}</strong>
            <br><br>
            <form action="" ref="project_update_form" id="project_update_form">
                <label for="project_name">Project name</label><br>
                <input type="text" name="name" id="project_name" v-model="project.name"><br><br>
                <label for="project_color">Color</label><br>
                <input type="text" name="name" id="project_color" v-model="project.color"><br><br>
                <label for="project_category">Category</label><br>
                <select name="category_id" id="project_category" v-model="project.category_id">
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </select><br><br><br><br>
                <label for="project_thumbnail">Thumbnail</label><br>
                <input type="file" id="project_thumbnail" name="thumbnail" ref="project_thumbnail" @change="setThumbnail"><br>
                <a href="#" @click="clearThumbnail">Clear thumbnail</a> <br><br><br><br>
                <label for="project_name">Project description</label><br><br>
                <quill-editor v-model="project.description"></quill-editor>
                <br><br><br><br>
                <button @click.prevent="save">Save</button>
                <a href="#" @click="deleteProject">Delete</a>
            </form>
        </div>
    </div>
</template>

<script>
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'

export default {

    name: "project-editor",
    props: ['categories'],
    components: {
        quillEditor
    },
    data() {
        return {
            project: null
        }
    },
    methods: {
        save() {
            let data = {
                project: this.project
            };
            axios.put("/project/" + this.project.id, data);
        },
        setThumbnail() {
            let uploadFormData = new FormData(this.$refs.project_update_form);
            axios.post("/project/" + this.project.id + "/setthumbnail", uploadFormData);
        },
        clearThumbnail() {
            axios.post('/project/' + this.project.id + '/clearthumbnail');
        },
        deleteProject() {
            axios.delete('/project/' + this.project.id).then((response) => {
                window.location.reload();
            })
        }
    },
    created() {
        window.Event.listen("project", (id) => {
            axios.get('/project/' + id)
                .then((response) => {
                    this.project = response.data;
                }).catch((error) => {

            })
        })
    },
    mounted() {
    },
    beforeDestroy() {
    },

}
</script>

<style scoped>
.projectEditor {
    padding: 2rem;
    background-color: #ffffff;
    box-sizing: border-box;
    margin-bottom: 2rem;
    display: inline-block;
}
</style>
