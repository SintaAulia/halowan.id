@extends('layouts.main')

@section('content')
<section class="section" style="min-height: 50vh; display: flex; align-items: center;">
    <div class="container narrow center">
        <p class="eyebrow-dark">404</p>
        <h1>Halaman Tidak Ditemukan</h1>
        <p class="lead">Maaf, halaman yang kamu cari tidak tersedia atau sudah dipindahkan.</p>
        <a class="btn btn-primary" href="{{ route('home') }}">Kembali ke Beranda</a>
    </div>
</section>
@endsection
