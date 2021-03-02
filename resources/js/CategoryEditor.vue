<template>
    <div class="categoryEditor">
        <div v-if="this.category">
            Category {{ this.category.id }}
            <form action="">
                <label for="name">Category name</label>
                <input type="text" name="name" id="name" v-model="category.name"><br>
                <button @click.prevent="save">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
module.exports = {
    name: "category-editor",
    data() {
        return {
            category: null
        }
    },
    methods: {
        save() {
            let data = {
                category: this.category,
                origin: "dashboard"
            }
            axios.put("/category/" + this.category.id, data);
        }
    },
    created() {
        window.Event.listen("category", (id) => {
            axios.get('/category/' + id)
                .then((response) => {
                    this.category = response.data;
                }).catch((error) => {

            })
        })
    }

}
</script>

<style scoped>
.categoryEditor {
    padding: 2rem;
    background-color: #ffffff;
    box-sizing: border-box;
    margin-bottom: 2rem;
}
</style>
