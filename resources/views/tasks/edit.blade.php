<x-layout title="Modify Task">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Modify Task</span>
                    <a href="{{ route('projects.index') }}" class="btn btn-sm btn-secondary">
                        Back
                    </a>
                </div>
                

                <div class="card-body">

                    {{-- Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- Full edit accesss (Admin,Privileged) --}}
                    @if(auth()->user()->can('update', $task))

                        <form method="POST" action="{{ route('tasks.update', $task) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text"
                                       name="title"
                                       class="form-control"
                                       value="{{ old('title', $task->title) }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description"
                                          class="form-control"
                                          rows="4">{{ old('description', $task->description) }}</textarea>
                            </div>
                            <div class="mb-3">
    <label class="form-label">Assign To</label>

    <select name="assigned_to[]" class="form-select" multiple>

        @foreach(\App\Models\User::whereIn('role', ['employee', 'privileged', 'admin'])->get() as $user)

            <option value="{{ $user->id }}"
                @selected($task->assignments->pluck('to_id')->contains($user->id))>

                {{ $user->name }} ({{ $user->role }})

            </option>

        @endforeach

    </select>

    <small class="text-muted">
        Hold CTRL (Windows) / CMD (Mac) to select multiple users or unselect.
    </small>
</div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="To Do" @selected($task->status === 'To Do')>To Do</option>
                                    <option value="In Progress" @selected($task->status === 'In Progress')>In Progress</option>
                                    <option value="Done" @selected($task->status === 'Done')>Done</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deadline</label>
                                <input type="date"
                                       name="deadline"
                                       class="form-control"
                                       value="{{ old('deadline', $task->deadline) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>
                        </form>


                    {{-- Status only access (Assigned users) --}}
                    @elseif(auth()->user()->can('updateStatus', $task))

                        <form method="POST" action="{{ route('tasks.updateStatus', $task) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Status</label>

                                <select name="status" class="form-select">
                                    <option value="To Do" @selected($task->status === 'To Do')>To Do</option>
                                    <option value="In Progress" @selected($task->status === 'In Progress')>In Progress</option>
                                    <option value="Done" @selected($task->status === 'Done')>Done</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Update Status
                            </button>
                        </form>
                        


                    {{-- NO ACCESS --}}
                    @else

                        <div class="alert alert-danger">
                            You are not authorized to modify this task.
                        </div>

                    @endif
                    @can('delete', $task)
                        <form method="POST"
                            action="{{ route('tasks.destroy', $task) }}"
                            class="mt-2"
                            onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Delete Task
                            </button>
                        </form>
                    @endcan
                </div>
                
            </div>

            
        </div>
    </div>
    

</x-layout>