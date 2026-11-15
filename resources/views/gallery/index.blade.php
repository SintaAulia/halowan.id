@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Gallery Komunitas</h1>
        <p>Momen-momen seru dan hangat dari kegiatan komunitas Halowan.id.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if ($photos->isNotEmpty())
            <div class="gallery">
                @foreach ($photos as $p)
                    <figure>
                        <img src="{{ media_url($p->gambar) }}" alt="{{ $p->judul }}" loading="lazy">
                        <figcaption>{{ $p->judul }}</figcaption>
                    </figure>
                @endforeach
            </div>
        @else
            <p class="empty">Galeri masih kosong.</p>
        @endif
    </div>
</section>
@endsection
