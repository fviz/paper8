<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Francisco Vizentin</title>
    <link rel="stylesheet" href="dist/css/app.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">
    <link rel="manifest" href="/icons/site.webmanifest">
</head>
<body>

<div id="app">
    <div class="musicPlayer">
        <svg class="playButton" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="playerActionText">
            Play tape
        </div>
    </div>
    <div class="menuContainer">
        <div class="homelink">
            <strong><a to="homepage">Francisco Vizentin</a></strong>
        </div>
        <div class="menu">
            <ul>
                <br>
                @foreach($categories as $category)
                <li>
                    <div class="menuSectionTitle">
                        <a to="/projects">{{ $category->name }}</a>
                    </div>
                    <hr>
                    <ul>
                        @foreach($projects as $project)
                            @if($project->category->name == $category->name)
                                <li><a to="/project-1">{{ $project->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <br>
                </li>
                @endforeach

                <li><a to="about">About & Contact</a></li>
            </ul>
        </div>

    </div>
    <div class="pageContentContainer">

        <div class="projectGrid">
            @foreach($projects as $project)
                <div class="projectCell" style="color: {{$project->color}}; background-image: url('{{ Storage::url($project->thumbnail) }}')">

                    <div class="projectTitle">
                        {{$project->name}}
                    </div>

                    <div class="categoryTag">
                        {{$project->category->name}}<br>
                        {{$project->created_at }}
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</div>

<script src="dist/js/app.js"></script>
</body>
</html>
