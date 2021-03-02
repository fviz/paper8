<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="This is my personal portfolio. I work with design, art and technology to explore areas such as AI, the digital world and multimedia. ">
    <title>Francisco Vizentin – Media art and design portfolio</title>
    <link rel="stylesheet" href="dist/css/app.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/site.webmanifest">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Y59ZLL498J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-Y59ZLL498J');
    </script>
</head>
<body>

<div id="app">
    <div class="musicPlayer">
        <svg class="playButton" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="playerActionText">
            Play tape
        </div>
    </div>
    <div class="menuContainer" :class="menuOpen ? 'menuContainerOpen' : ''">
        <div class="menu">
            <ul>
                <br>
                <br>
                <br>
                <br>
                <li v-for="category in categories">
                    <div class="menuSectionTitle" @click="setCategoryFilter(category)">
                        @{{category.name}}
                    </div>
                    <hr>
                    <br>
                </li>
                <li><a to="about">About & Contact</a></li>
            </ul>
        </div>
        <div class="homelink">
            <div @click="switchMenu">
                <svg v-if="!menuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg v-if="menuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <strong><a @click="goHome">Francisco<br>Vizentin</a></strong>

        </div>
    </div>
    <div class="pageContentContainer">
        <div :class="collapseSplash ? 'splash splashCollapse' : 'splash'">
            <div>
                <h1>
                    Hello,<br>
                    this is my website
                </h1>

            </div>
            <div style="text-align: right; padding-right: 2rem; line-height: 1.5rem">
                I work with AI, visuals,<br>music and technology
            </div>
        </div>

        <div v-for="category in filteredCategories" class="section">
            <div class="sectionTitle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 17l-4 4m0 0l-4-4m4 4V3"/>
                </svg>
                @{{ category.name }}
            </div>
            <div class="projectGrid">
                <div class="projectCell"
                     v-for="project in category.projects"
                     :style="`color: ${project.color}; background-image: url('/storage/thumbnails/${project.thumbnail}')`"
                     @click.stop="openProjectPopup(project.id)">

                    <div class="projectTitle">
                        @{{project.name}}
                    </div>

                    <div class="categoryTag">
                        <div v-if="project.category">
                            @{{project.category.name}}<br>
                        </div>
                        @{{ project.created_at }}
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>
                That's it<br>
                Francisco Vizentin © 2021
            </div>
        </div>

    </div>

    <project-popup></project-popup>
</div>

<script src="dist/js/app.js"></script>
</body>
</html>
