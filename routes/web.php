<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Project;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you ucan register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $projects = Project::all()->sortByDesc('created_at');
    $categories = Category::all();
    return view('index', ["projects" => $projects, "categories" => $categories]);
});

Route::get('/login', function() {
    return view('login');
});

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    $projects = Project::all()->sortByDesc('created_at');
    $categories = Category::all();
    return view('dashboard', ["projects" => $projects, "categories" => $categories]);
})->middleware('auth');

Route::resource('category', \App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::resource('project', \App\Http\Controllers\ProjectController::class)->middleware('auth');
Route::resource('project', \App\Http\Controllers\ProjectController::class)->except([
    'create', 'store', 'edit', 'update', 'destroy', 'setThumbnail', 'clearThumbnail'
]);
Route::get('/homeindex', [\App\Http\Controllers\ProjectController::class, 'homeIndex']);
Route::post('/project/{project}/setthumbnail', [\App\Http\Controllers\ProjectController::class, 'setThumbnail'])->middleware('auth');
Route::post('/project/{project}/clearthumbnail', [\App\Http\Controllers\ProjectController::class, 'clearThumbnail'])->middleware('auth');
