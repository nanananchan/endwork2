<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        $this->authorize('create', Task::class);
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'deadline' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'deadline' => $request->deadline ?? null,
            'project_id' => $request->project_id,
            'creator_id' => auth()->id(),
        ]);

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
{
    if (
        auth()->user()->cannot('update', $task) &&
        auth()->user()->cannot('updateStatus', $task)
    ) {
        abort(403);
    }

    return view('tasks.edit', compact('task'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
{
    $this->authorize('update', $task);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string',
        'deadline' => 'nullable|date',
        'assigned_to' => 'nullable|array',
        'assigned_to.*' => 'exists:users,id',
    ]);

    $task->update($request->only(
        'title', 'description', 'status', 'deadline'
    ));

    //  MULTIPLE ASSIGNEES (sync style)
    if ($request->filled('assigned_to')) {

        // remove old
        $task->assignments()->delete();

        // add many
        foreach ($request->assigned_to as $userId) {
            $task->assignments()->create([
                'to_id' => $userId,
                'from_id' => auth()->id(),
            ]);
        }
    } else {
        $task->assignments()->delete();
    }

    return redirect()->route('projects.index');
}

    public function updateStatus(Request $request, Task $task)
{
    $this->authorize('updateStatus', $task);
    $validated = $request->validate([
        'status' => ['required', 'string', 'max:50'],
    ]);

    $task->update([
        'status' => $validated['status'],
    ]);

    return redirect()->route('projects.index')->with('success', 'Task status updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        
        $this->authorize('delete', $task);

        $task->delete();
        return redirect()->route('projects.index');
    }
}
