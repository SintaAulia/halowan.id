@extends('layouts.admin')

@section('content')
@php
    $isEdit = $event !== null;
    $action = $isEdit ? route('admin.events.update', $event->id) : route('admin.events.store');
    $tgl    = $isEdit ? $event->tanggal->format('Y-m-d\TH:i') : '';
@endphp

<header class="admin-head">
    <h1>{{ $isEdit ? 'Edit Event' : 'Event Baru' }}</h1>
    <a class="btn btn-outline" href="{{ route('admin.events') }}">Kembali</a>
</header>

<form class="form panel" method="post" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    <div class="field">
        <label for="judul">Judul Event</label>
        <input id="judul" name="judul" type="text" maxlength="150" required value="{{ old('judul', $event?->judul) }}" placeholder="Contoh: Halowan Community Meetup #1">
    </div>
    <div class="field-row">
        <div class="field">
            <label for="tanggal">Tanggal &amp; Jam</label>
            <input id="tanggal" name="tanggal" type="datetime-local" required value="{{ old('tanggal', $tgl) }}">
        </div>
        <div class="field">
            <label for="lokasi">Lokasi</label>
            <input id="lokasi" name="lokasi" type="text" maxlength="150" required value="{{ old('lokasi', $event?->lokasi) }}" placeholder="Online (Zoom) / Nama Tempat">
        </div>
    </div>
    <div class="field">
        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="8" required placeholder="Tuliskan detail jadwal, narasumber, dan agenda kegiatan...">{{ old('deskripsi', $event?->deskripsi) }}</textarea>
    </div>
    <div class="field">
        <label for="banner">Banner (opsional)</label>
        @if ($isEdit && $event->banner)
            <img class="thumb" src="{{ media_url($event->banner) }}" alt="Banner saat ini">
        @endif
        <input id="banner" name="banner" type="file" accept="image/jpeg,image/png,image/webp,image/gif">
        <small class="hint">JPG, PNG, WEBP, atau GIF. Maksimal 2 MB.{{ $isEdit ? ' Kosongkan jika tidak ingin mengganti.' : '' }}</small>
    </div>
    <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Simpan Perubahan' : 'Buat Event' }}</button>
</form>
@endsection
