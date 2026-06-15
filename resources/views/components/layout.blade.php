<!DOCTYPE html>
<html>
<head>
  <title>{{ $title ?? 'ProjectApp' }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-secondary bg-opacity-25">

<!-- NAVBAR -->
<nav class="navbar navbar-light bg-light border-bottom px-3">
  <span class="navbar-brand mb-0 h1">ProjectApp</span>
  <div class="d-flex align-items-center gap-3 ms-auto">
  @auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">
            Manage Users
        </a>
    @endif
@endauth  
  @auth
      <span class="border px-3 py-1 bg-white"><strong id="username-display">{{ auth()->user()->name }}</strong></span>
      <form method="POST" action="{{ route('logout') }}" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
      </form>
    @endauth
  </div>
</nav>

<!-- MAIN CONTENT -->
<div class="container-fluid mt-4">
  {{ $slot }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{ $scripts ?? '' }}

</body>
</html>
