<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-color: #e0e0e0;
            font-family: sans-serif;
            color: black;
        }

        #dashboardapp {
            display: grid;
            grid-template-columns: 300px 1fr;
            grid-gap: 2rem;
        }

        .list {
            display: grid;
            grid-auto-rows: 2rem;
            width: 300px;
            grid-gap: 2px;
        }

        .list > * {
            background: #bababa;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .list > *:hover {
            background-color: #cbcbcb;
        }

        .listTitleBar {
            display: flex;
            justify-content: space-between;
        }

        a, a:hover, a:visited {
            color: white;
        }
    </style>
</head>
<body>
<div id="dashboardapp">

    <div class="menu">
        <a href="/logout">Logout</a><br><br>

        <div class="list">
            <div class="listTitleBar">
                <strong>Categories</strong>
                <div class="action">Add</div>
            </div>
            @foreach($categories as $category)
                <div @click="openCategory({{$category->id}})">
                    {{$category->name}}
                </div>

            @endforeach
        </div>

        <br><br>
        <div class="list">
            <div class="listTitleBar">
                <strong>Projects</strong>
                <div class="action" @click="addProject">Add</div>
            </div>
            @foreach($projects as $project)
                <div @click="openProject({{$project->id}})">
                    {{$project->name}}
                </div>
            @endforeach
        </div>
    </div>
    <div class="editor">
        <br><br>
        <category-editor></category-editor>
        <project-editor :categories="{{$categories->toJson()}}"></project-editor>
    </div>

</div>


<script src="/dist/js/dashboard.js"></script>
</body>
</html>
