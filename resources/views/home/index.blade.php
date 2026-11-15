@extends('layouts.main')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="eyebrow">Komunitas · Event · Inspirasi</span>
            <h1>Halo! Ayo tumbuh bareng di <span class="hl">Halowan.id</span></h1>
            <p class="hero-lead">Tempat berkumpulnya orang-orang yang ingin belajar, berbagi, dan membangun koneksi nyata lewat event seru, artikel, dan cerita dari anggota.</p>
            <div class="hero-cta">
                @auth
                    <a class="btn btn-primary btn-lg" href="{{ route('events.index') }}">Jelajahi Event</a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('register') }}">Gabung Sekarang</a>
                @endauth
                <a class="btn btn-outline-light btn-lg" href="{{ route('events.index') }}">Lihat Event</a>
            </div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <svg viewBox="0 0 420 340" role="img" focusable="false">
                <defs>
                    <linearGradient id="g-navy" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#0f2b57"/><stop offset="1" stop-color="#071936"/>
                    </linearGradient>
                    <linearGradient id="g-cyan" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0" stop-color="#04ccff"/><stop offset="1" stop-color="#00a3cc"/>
                    </linearGradient>
                </defs>
                <circle cx="210" cy="170" r="150" fill="#ffffff" opacity=".22"/>
                <circle cx="210" cy="170" r="105" fill="#ffffff" opacity=".25"/>
                <rect x="40" y="40" width="210" height="110" rx="26" fill="url(#g-navy)"/>
                <path d="M80 150 L70 190 L115 150 Z" fill="#071936"/>
                <rect x="64" y="70" width="120" height="12" rx="6" fill="#04ccff"/>
                <rect x="64" y="96" width="162" height="12" rx="6" fill="#ffffff" opacity=".95"/>
                <rect x="64" y="120" width="90" height="12" rx="6" fill="#ffffff" opacity=".75"/>
                <rect x="170" y="170" width="210" height="110" rx="26" fill="#ffffff"/>
                <path d="M340 280 L352 316 L305 280 Z" fill="#ffffff"/>
                <rect x="194" y="198" width="130" height="12" rx="6" fill="#0a1f44"/>
                <rect x="194" y="224" width="160" height="12" rx="6" fill="url(#g-cyan)"/>
                <rect x="194" y="248" width="96" height="12" rx="6" fill="#04ccff" opacity=".6"/>
                <circle cx="355" cy="60" r="11" fill="#ffffff" opacity=".95"/>
                <circle cx="62" cy="262" r="14" fill="#0a1f44" opacity=".85"/>
                <circle cx="388" cy="132" r="7" fill="#ffffff" opacity=".9"/>
            </svg>
        </div>
    </div>
</section>

<section class="stats">
    <div class="container stats-grid">
        <div class="stat"><b>{{ number_format($stats['anggota'], 0, ',', '.') }}</b><span>Anggota</span></div>
        <div class="stat"><b>{{ number_format($stats['event'], 0, ',', '.') }}</b><span>Event</span></div>
        <div class="stat"><b>{{ number_format($stats['diskusi'], 0, ',', '.') }}</b><span>Diskusi</span></div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Event Terbaru</h2>
                <p class="muted">Bertemu, belajar, dan bertumbuh bersama.</p>
            </div>
            <a class="btn btn-outline" href="{{ route('events.index') }}">Semua Event</a>
        </div>
        @if ($events->isNotEmpty())
            <div class="grid grid-3">
                @foreach ($events as $ev)
                    @include('partials.event_card', ['ev' => $ev])
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada event mendatang. Pantau terus ya!</p>
        @endif
    </div>
</section>

<section class="section section-soft">
    <div class="container two-col">
        <div>
            <div class="section-head">
                <div>
                    <h2>Diskusi Terbaru</h2>
                    <p class="muted">Ikut ngobrol, tanya, dan berbagi pengalaman.</p>
                </div>
                <a class="btn btn-outline" href="{{ route('forum.index') }}">Ke Forum</a>
            </div>
            @include('partials.topic_list', ['topics' => $topics])
        </div>
        <aside class="about-box">
            <h3>Kenapa Halowan?</h3>
            <ul class="checks">
                <li>Event rutin, online maupun tatap muka</li>
                <li>Forum yang ramah dan saling mendukung</li>
                <li>Artikel dan cerita dari sesama anggota</li>
                <li>Jejaring yang tumbuh dari kegiatan nyata</li>
            </ul>
            <a class="btn btn-navy btn-block" href="{{ route('about') }}">Kenali Halowan</a>
        </aside>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <h2>Artikel Terbaru</h2>
                <p class="muted">Bacaan ringan dan bermanfaat dari komunitas.</p>
            </div>
            <a class="btn btn-outline" href="{{ route('articles.index') }}">Semua Artikel</a>
        </div>
        @if ($articles->isNotEmpty())
            <div class="grid grid-3">
                @foreach ($articles as $ar)
                    @include('partials.article_card', ['ar' => $ar])
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada artikel.</p>
        @endif
    </div>
</section>

@guest
<section class="cta-band">
    <div class="container cta-inner">
        <div>
            <h2>Siap bergabung?</h2>
            <p>Daftar gratis dan mulai terhubung dengan anggota komunitas hari ini.</p>
        </div>
        <a class="btn btn-navy btn-lg" href="{{ route('register') }}">Buat Akun</a>
    </div>
</section>
@endguest
@endsection
