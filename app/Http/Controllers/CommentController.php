<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;


class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $this->authorize('createForTask', [Comment::class, $task]);

        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        Comment::create([
            'content' => $request->content,
            'task_id' => $task->id,
            'creator_id' => auth()->id(),
        ]);

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back();
    }
}
