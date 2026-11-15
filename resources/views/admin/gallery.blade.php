@extends('layouts.admin')

@section('admin_content')
<header class="admin-head">
    <h1>Kelola Galeri</h1>
</header>

<form class="form panel" method="post" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="field-row">
        <div class="field">
            <label for="judul">Judul foto</label>
            <input id="judul" name="judul" type="text" maxlength="100" required value="{{ old('judul') }}">
            @error('judul')
                <div class="field-error" style="color: #dc2626; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
        <div class="field">
            <label for="gambar">Gambar</label>
            <input id="gambar" name="gambar" type="file" accept="image/jpeg,image/png,image/webp,image/gif" required>
            @error('gambar')
                <div class="field-error" style="color: #dc2626; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Unggah</button>
</form>

@if ($photos->isEmpty())
    <p class="empty">Galeri masih kosong.</p>
@else
<div class="gallery admin-gallery">
    @foreach ($photos as $p)
        <figure>
            <img src="{{ media_url($p->gambar) }}" alt="{{ $p->judul }}" loading="lazy">
            <figcaption>
                {{ $p->judul }}
                <form method="post" action="{{ route('admin.gallery.delete', $p->id) }}" onsubmit="return confirm('Hapus foto ini?')">
                    @csrf
                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                </form>
            </figcaption>
        </figure>
    @endforeach
</div>
@endif
@endsection
