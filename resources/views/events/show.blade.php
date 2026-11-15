@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <a class="back" href="{{ route('events.index') }}">&larr; Semua event</a>
        <h1>{{ $event->judul }}</h1>
        <p>{{ tanggal($event->tanggal, true) }} · 📍 {{ $event->lokasi }}</p>
    </div>
</section>

<section class="section">
    <div class="container two-col two-col-wide">
        <div>
            @if ($event->banner)
                <img class="hero-img" src="{{ media_url($event->banner) }}" alt="Banner {{ $event->judul }}">
            @endif
            <div class="prose">{!! nl2br(e($event->deskripsi)) !!}</div>
        </div>

        <aside class="about-box">
            <h3>Detail Event</h3>
            <dl class="details">
                <dt>Tanggal</dt><dd>{{ tanggal($event->tanggal, true) }}</dd>
                <dt>Lokasi</dt><dd>{{ $event->lokasi }}</dd>
                <dt>Peserta</dt><dd>{{ $event->participants()->count() }} terdaftar</dd>
            </dl>

            @if ($isPast)
                <p class="empty">Event ini sudah berlalu.</p>
            @elseif (!Auth::check())
                <a class="btn btn-primary btn-block" href="{{ route('login') }}">Masuk untuk mendaftar</a>
            @elseif ($registered)
                <p class="badge badge-ok">✓ Kamu sudah terdaftar</p>
                <form method="post" action="{{ route('events.unregister', $event->slug) }}" onsubmit="return confirm('Batalkan pendaftaranmu di event ini?')">
                    @csrf
                    <button class="btn btn-outline btn-block" type="submit">Batalkan Pendaftaran</button>
                </form>
            @else
                <form method="post" action="{{ route('events.register', $event->slug) }}">
                    @csrf
                    <button class="btn btn-primary btn-block" type="submit">Daftar Event</button>
                </form>
            @endif
        </aside>
    </div>
</section>
@endsection
