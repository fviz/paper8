<template>
    <div class="projectPopupContainer"
         v-show="true"
         @click.self="close"
         :class="isOpen ? 'flipProject' : ''">
        <div class="projectPopup">
            <div class="topBar" v-if="project">
                <div class="title">{{ this.project.name }}</div>
                <div class="closeButton" @click="close">
                    Close
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="projectDetails">
                    <div class="projectCategory">
                        <div><strong>Category</strong></div>
                        <div v-if="this.project.category != null">{{ this.project.category.name }}</div>
                    </div>
                    <div class="projectDate">
                        <div><strong>Publication Date</strong></div>
                        <div>{{ this.project.created_at }}</div>
                    </div>
                    <div class="projectTags">
                        <div><strong>Tags</strong></div>
                        <div>Art, Design, Media, AI</div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="content" v-if="project" v-html="project.description">
            </div>
            <div class="thumbnail">
                <img :src="'/storage/thumbnails/'+ this.project.thumbnail" alt="" v-if="project">
            </div>

            <div v-if="project == null" class="loading">Loading...</div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ProjectPopup",
    data() {
        return {
            isOpen: false,
            project: null
        }
    },
    methods: {
        close() {
            this.isOpen = false;
            setTimeout(function() {
                this.project = null;
            }, 2000);

        }
    },
    created() {
        window.Event.listen('openProjectPopup', (id) => {
            this.isOpen = true;
            axios.get('/project/' + id)
                .then((response) => {
                    console.log(response.data);
                    this.project = response.data;
                })
        });

        window.Event.listen('goHome', () => this.close());
        window.Event.listen('closeProject', () => this.close());
    }

}
</script>

<style scoped>

.projectPopupContainer {
    background-color: rgba(255, 255, 255, 0.96);
    width: 100vw;
    height: 100vh;
    top: 100vh;
    z-index: 100;
    display: grid;
    grid-template-columns: 340px 1fr;
    grid-template-areas: "gap content";
    position: fixed;
    transition: all 500ms cubic-bezier(0.8, 0, 0.2, 1);
}

.flipProject {
    top: 0;
}

@media (max-width: 1000px) {

    .projectPopupContainer {
        grid-template-columns: 80px 1fr;
        padding-top: 4rem;
    }

}

@media (max-width: 800px) {

    .projectPopupContainer {
        grid-template-columns: 1fr;
        grid-template-areas: "content";
    }

}

.projectPopup {
    min-height: 100vh;
    max-height: 100vh;
    width: 100%;
    background-color: #ffffff;
    right: 0;
    bottom: 0;
    padding: 2rem;
    box-sizing: border-box;
    overflow-y: scroll;
    overflow-x: hidden;
    grid-area: content;
    align-self: end;
    justify-self: end;
}

img {
    max-width: 100%;
}

.thumbnail {
    padding-bottom: 10rem;
}

.closeButton {
    cursor: pointer;
    display: flex;
    align-items: center;
    grid-area: close;
    opacity: 0.4;
    transition: all 200ms ease-in-out;
}

.closeButton:hover {
    opacity: 1;
}

.title {
    grid-area: title;
    font-size: 6rem;
    padding-bottom: 2rem;
    hyphens: auto;
}

.closeButton > svg:nth-child(1) {
    display: inline-block;
    height: 2rem;
}

.content {
    max-width: 800px;
    padding-bottom: 4rem;
    line-height: 1.5rem;
    margin-top: 4rem;
}

.content >>> img {
    max-width: 100%;
    margin-left: -4rem;
}

.content >>> p {
    margin-left: 4rem;
}

.content >>> blockquote {
    margin-left: 6rem;
    border-left: 2px solid rgb(189, 189, 189);
    padding-left: 2rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
    color: gray;
}

.topBar {
    display: grid;
    grid-template-columns: 1fr auto;
    grid-template-areas: "title close";
    margin-top: 4rem;
    grid-gap: 2rem;
}

@media (max-width: 1000px) {
    .topBar {
        grid-template-columns: 100%;
        grid-template-rows: auto auto;
        grid-template-areas:  "close" "title";
    }
}

@media (max-width: 650px) {
    .title {
        font-size: 5rem;
    }
}

.loading {
    text-align: center;
    color: #2d3748;
    font-size: 0.8rem;
}

.projectDetails {
    max-width: 800px;
    margin-bottom: 2rem;
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    color: rgba(0,0,0,0.8);
    padding-left: 4rem;
}

@media (max-width: 600px) {
    .projectPopup {
        max-width: 100vw;
    }
    .projectTags {
        grid-column: span 2;
    }
    .projectDetails {
        padding-left: 0;
        display: grid;
        grid-gap: 2rem;
        grid-template-columns: repeat(2, auto);
        grid-template-rows: repeat(2, 1fr);
    }
}

</style>

<style>

img {
    max-width: 100%;
}
</style>
