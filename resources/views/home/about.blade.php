@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>About Halowan.id</h1>
        <p>Komunitas yang dibangun dari sapaan sederhana: "halo".</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <p class="lead">Halowan.id adalah ruang bersama bagi siapa saja yang ingin belajar, berbagi, dan bertumbuh lewat kegiatan nyata dan percakapan yang hangat.</p>
        <p>Kami percaya koneksi yang baik berawal dari hal kecil: menyapa, bertanya, lalu saling membantu. Karena itu Halowan.id menyediakan event, forum diskusi, dan artikel agar setiap anggota punya tempat untuk bersuara dan didengar.</p>
    </div>

    <div class="container grid grid-3 values">
        <div class="card card-body"><h3>Ramah</h3><p>Semua orang disambut. Perbedaan latar belakang adalah kekuatan komunitas.</p></div>
        <div class="card card-body"><h3>Berbagi</h3><p>Ilmu dan pengalaman paling berguna ketika dibagikan dan dibahas bersama.</p></div>
        <div class="card card-body"><h3>Bertumbuh</h3><p>Kami mendorong anggota mencoba hal baru dan saling mendukung prosesnya.</p></div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div>
            <h2>Punya ide kolaborasi?</h2>
            <p>Kami terbuka untuk kegiatan, kemitraan, dan masukan dari siapa pun.</p>
        </div>
        <a class="btn btn-navy btn-lg" href="{{ route('contact') }}">Hubungi Kami</a>
    </div>
</section>
@endsection
