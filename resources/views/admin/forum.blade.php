@extends('layouts.admin')

@section('admin_content')
<header class="admin-head">
    <h1>Moderasi Forum</h1>
</header>

@if ($topics->isEmpty())
    <p class="empty">Belum ada topik.</p>
@else
<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>
                <th>Topik</th>
                <th>Penulis</th>
                <th>Komentar</th>
                <th>Dibuat</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($topics as $t)
            <tr>
                <td><a href="{{ route('forum.show', $t->id) }}">{{ $t->judul }}</a></td>
                <td>{{ $t->penulis ?? $t->user?->name ?? 'Anonim' }}</td>
                <td>{{ $t->comments_count ?? $t->komentar ?? 0 }}</td>
                <td>{{ tanggal($t->created_at) }}</td>
                <td class="actions">
                    <form method="post" action="{{ route('admin.forum.delete', $t->id) }}" onsubmit="return confirm('Hapus topik ini beserta semua komentarnya?')">
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
