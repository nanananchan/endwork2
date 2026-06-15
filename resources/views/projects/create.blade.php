<x-layout title="Create Project">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Create Project</span>

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

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   required>
                        </div>

                        <button class="btn btn-primary">
                            Create Project
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</x-layout>