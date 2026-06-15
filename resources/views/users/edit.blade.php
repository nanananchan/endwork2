<x-layout title="Edit User">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Edit User</span>

                    {{-- DELETE BUTTON INSIDE EDIT --}}
                    @if(auth()->user()->can('delete', $user))
                        <form method="POST"
                              action="{{ route('users.destroy', $user) }}"
                              onsubmit="return confirm('Delete this user?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>

                        </form>
                    @endif
                </div>

                <div class="card-body">

                    {{-- ERRORS --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   value="{{ old('username', $user->username) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="employee" @selected($user->role === 'employee')>Employee</option>
                                <option value="privileged" @selected($user->role === 'privileged')>Privileged</option>
                                <option value="admin" @selected($user->role === 'admin')>Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (leave empty to keep current)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button class="btn btn-primary">
                            Save Changes
                        </button>



                    </form>

                    <br>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
    Back to Users
</a>

                </div>
            </div>

        </div>
    </div>

</x-layout>