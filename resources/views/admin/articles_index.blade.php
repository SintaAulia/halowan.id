@extends('layouts.admin')

@section('content')
<header class="admin-head">
    <h1>Kelola Artikel</h1>
    <a class="btn btn-primary" href="{{ route('admin.articles.create') }}">+ Artikel Baru</a>
</header>

@if ($articles->isEmpty())
    <p class="empty">Belum ada artikel.</p>
@else
<div class="table-wrap">
    <table class="table">
        <thead><tr><th>Judul</th><th>Penulis</th><th>Terbit</th><th></th></tr></thead>
        <tbody>
        @foreach ($articles as $a)
            <tr>
                <td><a href="{{ route('articles.show', $a->slug) }}">{{ $a->judul }}</a></td>
                <td>{{ $a->penulis ?? '-' }}</td>
                <td>{{ tanggal($a->created_at) }}</td>
                <td class="actions">
                    <a class="btn btn-sm btn-outline" href="{{ route('admin.articles.edit', $a->id) }}">Edit</a>
                    <form method="post" action="{{ route('admin.articles.delete', $a->id) }}" onsubmit="return confirm('Hapus artikel ini?')">
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
