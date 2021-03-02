require('./bootstrap');
import Vue from 'vue'
import ProjectPopup from "./ProjectPopup";

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

const app = new Vue({
    el: '#app',
    components: {ProjectPopup},
    methods: {
        openProjectPopup(id) {
            window.Event.fire('openProjectPopup', id);
            this.conditionallyCloseMenu();

        },
        goHome() {
            window.Event.fire('goHome', null);
            this.filteredCategoriesData = this.categories;
            this.conditionallyCloseMenu();
            window.scrollTo({top: 0, behavior: 'smooth'});
        },
        switchMenu() {
            this.menuOpen = !this.menuOpen;
        },
        setCategoryFilter(destination) {
            this.filteredCategoriesData = [destination];
            this.conditionallyCloseMenu();
            window.Event.fire('closeProject');
        },
        clearCategoryFilters() {
            this.filteredCategoriesData = this.categories;
        },
        conditionallyCloseMenu() {
            if (innerWidth <= 800) {
                this.menuOpen = false;
            }
        }
    },
    created() {
        axios.get('/homeindex').then((response) => {
            this.categories = response.data;
            this.filteredCategoriesData = this.categories;
        });
    },
    computed: {
        filteredCategories() {
            if (this.categories) {
                return this.filteredCategoriesData;
            } else {
                return [];
            }
        },
        collapseSplash() {
            if (this.categories === this.filteredCategoriesData) {
                return false;
            } else {
                return true;
            }
        }
    },
    data: {
        categories: null,
        filteredCategoriesData: null,
        menuOpen: false,
    }
})
