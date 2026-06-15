<div class="card mb-3 shadow-sm project-row"
     role="button"
     data-project-id="{{ $project->id }}"
     data-project-name="{{ $project->title }}">

    <div class="card-body">
        <h5 class="card-title">{{ $project->title }}</h5>

        <h6 class="card-subtitle mb-2 text-muted">
            {{ $project->tasks->count() }} task(s)
        </h6>

        <ul class="list-unstyled mb-0">
            @forelse($project->tasks as $task)
                <li>{{ $task->title }}</li>
            @empty
                <li class="text-muted">No tasks</li>
            @endforelse
        </ul>
        @if(auth()->user()->can('delete', $project))
    <form method="POST"
          action="{{ route('projects.destroy', $project) }}"
          class="d-inline"
          onsubmit="return confirm('Delete this project?')">

        @csrf
        @method('DELETE')

        <button class="btn btn-sm btn-danger mt-3">
            Delete
        </button>

    </form>
@endif
    </div>
</div>