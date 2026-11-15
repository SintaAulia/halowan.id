@extends('layouts.admin')

@section('content')
@php
    $isEdit = $article !== null;
    $action = $isEdit ? route('admin.articles.update', $article->id) : route('admin.articles.store');
@endphp

<header class="admin-head">
    <h1>{{ $isEdit ? 'Edit Artikel' : 'Artikel Baru' }}</h1>
    <a class="btn btn-outline" href="{{ route('admin.articles') }}">Kembali</a>
</header>

<form class="form panel" method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    <div class="field">
        <label for="judul">Judul Artikel</label>
        <input id="judul" name="judul" type="text" maxlength="150" required value="{{ old('judul', $article?->judul) }}" placeholder="Judul artikel...">
    </div>
    <div class="field">
        <label for="isi">Isi Artikel</label>
        <textarea id="isi" name="isi" rows="14" required placeholder="Tuliskan isi artikel lengkap di sini...">{{ old('isi', $article?->isi) }}</textarea>
        <small class="hint">Pisahkan paragraf dengan baris kosong.</small>
    </div>
    <div class="field">
        <label for="gambar">Gambar Sampul (opsional)</label>
        @if ($isEdit && $article->gambar)
            <img class="thumb" src="{{ media_url($article->gambar) }}" alt="Sampul saat ini">
        @endif
        <input id="gambar" name="gambar" type="file" accept="image/jpeg,image/png,image/webp,image/gif">
        <small class="hint">JPG, PNG, WEBP, atau GIF. Maksimal 2 MB.{{ $isEdit ? ' Kosongkan jika tidak ingin mengganti.' : '' }}</small>
    </div>
    <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Simpan Perubahan' : 'Terbitkan' }}</button>
</form>
@endsection
