<x-layout title="Create Task">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Create Task</span>

                    <a href="{{ route('projects.index') }}" class="btn btn-sm btn-secondary">
                        Back
                    </a>
                </div>

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="To Do">To Do</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            Create Task
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-layout>