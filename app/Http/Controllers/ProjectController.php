<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('category')->get();
        return response($projects, 200);
    }

    public function homeIndex() {
        $categories = Category::with('projects')->get();
        return response($categories, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newProject = new Project([
            "name" => "Untitled project"
        ]);
        $newProject->save();
        return response($newProject, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response($project->load('category'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->project);
        return response($project, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response("ok", 200);
    }

    public function setThumbnail(Request $request, Project $project) {
        $path = $request->file('thumbnail')->store('public/thumbnails');

        $optimizerChain = OptimizerChainFactory::create();

        $optimizerChain->optimize(App::storagePath() . "/app/" . $path);
        $project->thumbnail = $request->file('thumbnail')->hashName();
        $project->save();
        return $project;
    }

    public function clearThumbnail(Request $request, Project $project) {
        $project->thumbnail = "";
        $project->save();
        return response($project, 200);
    }
}
