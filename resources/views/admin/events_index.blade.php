@extends('layouts.admin')

@section('content')
<header class="admin-head">
    <h1>Kelola Event</h1>
    <a class="btn btn-primary" href="{{ route('admin.events.create') }}">+ Event Baru</a>
</header>

@if ($events->isEmpty())
    <p class="empty">Belum ada event.</p>
@else
<div class="table-wrap">
    <table class="table">
        <thead><tr><th>Judul</th><th>Tanggal</th><th>Lokasi</th><th>Peserta</th><th></th></tr></thead>
        <tbody>
        @foreach ($events as $ev)
            <tr>
                <td><a href="{{ route('events.show', $ev->slug) }}">{{ $ev->judul }}</a></td>
                <td>{{ tanggal($ev->tanggal, true) }}</td>
                <td>{{ $ev->lokasi }}</td>
                <td><a href="{{ route('admin.events.registrants', $ev->id) }}">{{ $ev->peserta }}</a></td>
                <td class="actions">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.events.edit', $ev->id) }}">Edit</a>
                    <form method="post" action="{{ route('admin.events.delete', $ev->id) }}" onsubmit="return confirm('Hapus event ini?')">
                        @csrf
                        <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
