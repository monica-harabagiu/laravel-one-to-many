<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('pages.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        $val_data['slug'] = $slug;

        if ($request->hasFile('img')) {
            $imagePath = Storage::disk('public')->put('img', $request['img']);
            $val_data['img'] = $imagePath;
        };

        $new_project = Project::create($val_data);

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        return view('pages.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        $val_data['slug'] = $slug;

        if ($request->hasFile('img')) {
            
            if ($project->img) {
                Storage::delete($project->img);
            };

            $imagePath = Storage::disk('public')->put('img', $request['img']);
            $val_data['img'] = $imagePath;
        };

        $project->update($val_data);

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        if ($project->img) {
            Storage::delete($project->img);
        };

        return redirect()->route('dashboard.projects.index');
    }
}
