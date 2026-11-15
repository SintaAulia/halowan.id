@extends('layouts.admin')

@section('content')
<header class="admin-head">
    <h1>Dashboard</h1>
</header>

<div class="admin-stats">
    @foreach ($stats as $label => $total)
        <div class="admin-stat"><b>{{ number_format($total, 0, ',', '.') }}</b><span>{{ $label }}</span></div>
    @endforeach
</div>

<div class="admin-cols">
    <section class="panel">
        <h2>Anggota Terbaru</h2>
        <ul class="plain-list">
            @foreach ($users as $u)
                <li>{{ $u->name }} <span class="meta">{{ $u->email }} · {{ tanggal($u->created_at) }}</span></li>
            @endforeach
        </ul>
        <a href="{{ route('admin.users') }}">Kelola anggota &rarr;</a>
    </section>

    <section class="panel">
        <h2>Diskusi Terbaru</h2>
        @if ($topics->isNotEmpty())
            <ul class="plain-list">
                @foreach ($topics as $t)
                    <li><a href="{{ route('forum.show', $t->id) }}">{{ $t->judul }}</a>
                        <span class="meta">{{ $t->penulis }} · {{ $t->komentar }} komentar</span></li>
                @endforeach
            </ul>
        @else
            <p class="empty">Belum ada diskusi.</p>
        @endif
        <a href="{{ route('admin.forum') }}">Moderasi forum &rarr;</a>
    </section>
</div>
@endsection
