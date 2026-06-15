<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
$projects = Project::with([
        'tasks.creator',
        'tasks.comments.creator',
        'tasks.assignments',
    ])->get();        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Project::create([
            'title' => $request->title,
            'creator_id' => auth()->id(),
        ]);
        return redirect()->route('projects.index');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $project->update([
            'title' => $request->title,
        ]);

        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {


    $this->authorize('delete', $project);
    $project->delete();
        return redirect()->route('projects.index');
    }
}
