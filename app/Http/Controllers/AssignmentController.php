<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Task;

class AssignmentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $user = auth()->user();

        if (!$user->canManageTasks()) {
            abort(403);
        }

        $request->validate([
            'to_id' => 'required|exists:users,id',
        ]);

        Assignment::create([
            'task_id' => $task->id,
            'to_id' => $request->to_id,
            'from_id' => $user->id,
        ]);

        $task->update(['assigned_to' => $request->to_id]);

        return redirect()->back();
    }
}
