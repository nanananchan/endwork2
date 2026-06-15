<x-layout title="Users">

    <div class="d-flex justify-content-between mb-3">
        <h4>Users</h4>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            Add User
        </a>
    </div>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>

    @if(auth()->user()->can('update', $user))
        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
            Edit
        </a>
    @endif

    

</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <a href="{{ url('/projects') }}" class="btn btn-sm btn-outline-secondary mb-3">
    Back to Projects
</a>

</x-layout>