<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($title) ? $title . ' · Halowan.id' : 'Halowan.id — Komunitas untuk tumbuh, berbagi, dan terhubung' }}</title>
    <meta name="description" content="{{ $metaDesc ?? 'Halowan.id adalah komunitas untuk tumbuh, berbagi, dan terhubung lewat event, diskusi, dan artikel.' }}">
    <meta name="theme-color" content="#04ccff">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<a class="skip-link" href="#konten">Lewati ke konten</a>

<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="" width="34" height="34">
            <span>Halowan<b>.id</b></span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="nav-menu">
            <span></span><span></span><span></span>
        </button>

        <nav id="nav-menu" class="nav-menu" aria-label="Navigasi utama">
            <ul class="nav-links">
                @php
                    $navItems = [
                        ['/', 'Home'],
                        ['event', 'Event'],
                        ['artikel', 'Artikel'],
                        ['galeri', 'Gallery'],
                        ['tentang', 'About Halowan'],
                    ];
                @endphp
                @foreach ($navItems as [$p, $label])
                    <li><a class="{{ nav_active($p) }}" href="{{ url($p) }}">{{ $label }}</a></li>
                @endforeach
            </ul>

            <div class="nav-auth">
                <a class="btn-donation {{ nav_active('donation') }}" href="{{ url('donation') }}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span>Donation</span>
                </a>

                @auth
                    <a class="nav-user" href="{{ route('account') }}">
                        {!! avatar(auth()->user(), 'avatar-sm') !!}
                        <span>{{ auth()->user()->name }}</span>
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a class="btn btn-sm btn-outline-light" href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-primary" type="submit">Keluar</button>
                    </form>
                @else
                    <a class="nav-login" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Gabung</a>
                @endauth
            </div>
        </nav>
    </div>
</header>

@include('partials.alerts')

<main id="konten">
    @yield('content')
</main>

<footer class="footer">
    <div class="container footer-grid">
        <div>
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="" width="34" height="34">
                <span>Halowan<b>.id</b></span>
            </a>
            <p class="footer-about">Komunitas untuk tumbuh, berbagi, dan terhubung. Bergabunglah dan jadi bagian dari cerita kami.</p>
        </div>
        <div>
            <h4>Jelajahi</h4>
            <ul>
                <li><a href="{{ url('event') }}">Event</a></li>
                <li><a href="{{ url('artikel') }}">Artikel</a></li>
                <li><a href="{{ url('galeri') }}">Gallery</a></li>
                <li><a href="{{ url('donation') }}">Donation</a></li>
            </ul>
        </div>
        <div>
            <h4>Komunitas</h4>
            <ul>
                <li><a href="{{ url('tentang') }}">About Halowan</a></li>
                <li><a href="{{ url('anggota') }}">Anggota</a></li>
                <li><a href="{{ url('kontak') }}">Kontak</a></li>
                <li><a href="{{ url('daftar') }}">Gabung</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">&copy; {{ date('Y') }} Halowan.id. Semua hak dilindungi.</div>
    </div>
</footer>

<script src="{{ asset('assets/js/app.js') }}" defer></script>
</body>
</html>
