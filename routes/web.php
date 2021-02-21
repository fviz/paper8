<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $projects = Project::all()->sortBy('created_at');
    $categories = Category::all();
    return view('index', ["projects" => $projects, "categories" => $categories]);
});
