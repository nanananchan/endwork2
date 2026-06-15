<div class="card mb-3 shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">
            <h5 class="card-title">{{ $task->title }}</h5>
            
            <span class="badge bg-{{ $task->status === 'Done' ? 'success' : ($task->status === 'In Progress' ? 'warning text-dark' : 'secondary') }}">
                {{ $task->status }}
            </span>
        </div>

        <p class="card-text">
            {{ $task->description }}
        </p>

        @if($task->deadline)
            <p class="text-muted mb-2">
                Due: {{ \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') }}
            </p>
        @endif

        <div class="small text-muted mb-3">
            Created by: {{ $task->creator->username }}
        </div>
         @if(auth()->user()->canManageTasks())
    <a href="{{ route('tasks.edit', $task) }}"
       class="btn btn-outline-secondary btn-sm">
        Modify
    </a>
@elseif(auth()->user()->can('updateStatus', $task))
    <a href="{{ route('tasks.edit', $task) }}"
       class="btn btn-outline-secondary btn-sm">
        Update Status
    </a>
@endif



<hr>

<div class="mb-3">
    <strong>Comments</strong>

    @forelse($task->comments as $comment)
    <div class="border rounded p-2 mt-2 d-flex justify-content-between">

        <div>
            <small class="text-muted">
                {{ $comment->creator->username }}
                •
                {{ $comment->created_at->format('Y-m-d H:i') }}
            </small>

            <div>
                {{ $comment->content }}
            </div>
        </div>

        
         @can('delete', $comment)
            <form method="POST"
                  action="{{ route('comments.destroy', $comment) }}">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Delete comment?')">
                    Delete
                </button>
            </form>
        @endcan

    </div>
@empty
    <p class="text-muted small mt-2">
        No comments yet.
    </p>
@endforelse
</div>

@if(
    auth()->user()->isAdmin()
    || auth()->user()->isPrivileged()
    || $task->assignments->contains('to_id', auth()->id())
)

<form method="POST"
      action="{{ route('comments.store', $task) }}"
      class="mt-3">

    @csrf

    <div class="input-group">
        <input type="text"
               name="content"
               class="form-control"
               placeholder="Add a comment..."
               required>

        <button type="submit"
                class="btn btn-outline-secondary">
            Add
        </button>
    </div>

</form>

@endif


       

    </div>
</div>