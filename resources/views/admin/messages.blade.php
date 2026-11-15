@extends('layouts.admin')

@section('admin_content')
<header class="admin-head">
    <h1>Pesan Masuk & Konfirmasi Donasi</h1>
</header>

@if ($messages->isEmpty())
    <p class="empty">Belum ada pesan.</p>
@else
    @foreach ($messages as $m)
        <article class="panel message">
            <header>
                <b>{{ $m->nama }}</b>
                <a href="mailto:{{ $m->email }}">{{ $m->email }}</a>
                <span class="meta">{{ tanggal($m->created_at, true) }}</span>
            </header>
            <p>{!! nl($m->pesan) !!}</p>
        </article>
    @endforeach
@endif
@endsection
