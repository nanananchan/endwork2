<x-layout title="Login">

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                value="{{ old('username') }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >
                        </div>

                        @error('username')
                            <div class="text-danger mb-3">
                                {{ $message }}
                            </div>
                        @enderror

                        <button type="submit" class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</x-layout>