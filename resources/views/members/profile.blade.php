@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container profile-head">
        {!! avatar($member, 'avatar-xl') !!}
        <div>
            <h1>{{ $member->name }}</h1>
            <p>Anggota sejak {{ tanggal($member->created_at) }}{{ $member->isAdmin() ? ' · Pengelola' : '' }}</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        @if ($member->bio)
            <h2>Tentang</h2>
            <div class="prose">{!! nl2br(e($member->bio)) !!}</div>
            <div style="margin-bottom: 2rem;"></div>
        @endif

        <h2>Event yang Diikuti</h2>
        @if ($events->isNotEmpty())
            <ul class="plain-list">
                @foreach ($events as $ev)
                    <li>
                        <a href="{{ route('events.show', $ev->slug) }}"><b>{{ $ev->judul }}</b></a>
                        <span class="meta">{{ tanggal($ev->tanggal) }} · 📍 {{ $ev->lokasi }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty">Belum mengikuti event.</p>
        @endif
    </div>
</section>
@endsection
