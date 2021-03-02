require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import CategoryEditor from "./CategoryEditor";
import ProjectEditor from './ProjectEditor';

window.Event = new class {
    constructor() {
        this.vue = new Vue();
    }

    fire(event, data = null) {
        this.vue.$emit(event, data);
    }

    listen(event, callback) {
        this.vue.$on(event, callback);
    }
};


// Vue.component("category-editor", CategoryEditor);

const app = new Vue({
    components: { CategoryEditor, ProjectEditor },
    methods: {
        open(destination, id) {
            window.Event.fire(destination, id);
        },
        openProject(id) {
            let destination = "project";
            this.open(destination, id);
        },
        openCategory(id) {
            let destination = "category";
            this.open(destination, id);
        },
        addProject() {
            let destination = "project";
            let newProject;
            axios.get('/project/create')
                .then((response) => {
                    newProject = response.data;
                    this.open(destination, newProject.id);
                });
        }
    }
}).$mount('#dashboardapp')
