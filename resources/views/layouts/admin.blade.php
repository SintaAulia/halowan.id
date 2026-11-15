<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? 'Admin' }} · Admin Halowan.id</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="admin-body">
<div class="admin-wrap">
    <aside class="admin-side">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="" width="34" height="34">
            <span>Halowan<b>.id</b></span>
        </a>
        <nav aria-label="Menu admin">
            <ul>
                @php
                    $menu = [
                        ['admin', 'Dashboard'],
                        ['admin/users', 'Anggota'],
                        ['admin/events', 'Event'],
                        ['admin/artikel', 'Artikel'],
                        ['admin/forum', 'Forum'],
                        ['admin/galeri', 'Gallery'],
                        ['admin/pesan', 'Pesan & Donasi'],
                    ];
                @endphp
                @foreach ($menu as [$p, $label])
                    @php
                        $active = $p === 'admin' ? request()->is('admin') : request()->is($p . '*');
                    @endphp
                    <li><a class="{{ $active ? 'is-active' : '' }}" href="{{ url($p) }}">{{ $label }}</a></li>
                @endforeach
            </ul>
        </nav>
        <div class="admin-side-foot">
            <a href="{{ url('/') }}">&larr; Lihat situs</a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-primary btn-block" type="submit">Keluar</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        @include('partials.alerts')
        @yield('content')
    </div>
</div>
<script src="{{ asset('assets/js/app.js') }}" defer></script>
</body>
</html>
