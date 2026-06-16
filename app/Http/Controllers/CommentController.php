<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;


class CommentController extends Controller
{

public function destroy(Comment $comment)
{
    $this->authorize('delete', $comment);

    $projectId = $comment->task()->value('project_id'); // ✅ safer, direct DB query

    $comment->delete();

    return redirect()->route('projects.index', ['project' => $projectId]);
}

public function store(Request $request, Task $task)
{
    $this->authorize('createForTask', [Comment::class, $task]);
    $request->validate([
        'content' => 'required|string|max:2000',
    ]);

    $projectId = $task->project_id; // ✅ already have $task injected

    Comment::create([
        'content' => $request->content,
        'task_id' => $task->id,
        'creator_id' => auth()->id(),
    ]);

    return redirect()->route('projects.index', ['project' => $projectId]);
}
}


