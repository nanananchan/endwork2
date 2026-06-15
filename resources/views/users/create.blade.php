<x-layout title="Create User">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    Create User
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

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="employee">Employee</option>
                                <option value="privileged">Privileged</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary">
                            Create User
                        </button>

                    </form>

                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary mb-3">
    Back to Users
</a>

                </div>
            </div>

        </div>
    </div>

</x-layout>