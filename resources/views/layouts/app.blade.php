<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $appName }} – @yield('title', 'Pagrindinis')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('tickets.index') }}">
            <i class="bi bi-ticket-perforated"></i>
            {{ $appName }}
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tickets.index') }}">
                            <i class="bi bi-list-ul"></i> Bilietai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tickets.create') }}">
                            <i class="bi bi-plus-circle"></i> Naujas bilietas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.index') }}">
                            <i class="bi bi-file-pdf"></i> PDF Ataskaita
                        </a>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-gear"></i> Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('categories.index') }}">
                                        <i class="bi bi-tags"></i> Kategorijos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('settings.index') }}">
                                        <i class="bi bi-sliders"></i> Nustatymai
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                        <span class="nav-link text-secondary">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="nav-link btn btn-link text-danger">
                                <i class="bi bi-box-arrow-right"></i> Atsijungti
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>