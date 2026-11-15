@extends('layouts.admin')

@section('content')
<header class="admin-head">
    <h1>Peserta: {{ $event->judul }}</h1>
    <a class="btn btn-outline" href="{{ route('admin.events') }}">Kembali</a>
</header>

@if ($peserta->isEmpty())
    <p class="empty">Belum ada yang mendaftar.</p>
@else
<div class="table-wrap">
    <table class="table">
        <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Waktu daftar</th></tr></thead>
        <tbody>
        @foreach ($peserta as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ tanggal($p->pivot->created_at ?? $p->created_at, true) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
