@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container narrow">
        <a class="back" href="{{ route('articles.index') }}">&larr; Semua artikel</a>
        <h1>{{ $article->judul }}</h1>
        <p>{{ tanggal($article->created_at) }}{{ $article->penulis ? ' · oleh ' . $article->penulis : '' }}</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        @if ($article->gambar)
            <img class="hero-img" src="{{ media_url($article->gambar) }}" alt="{{ $article->judul }}">
        @endif
        <div class="prose">{!! nl2br(e($article->isi)) !!}</div>
    </div>
</section>

@if ($more->isNotEmpty())
<section class="section section-soft">
    <div class="container">
        <h2>Baca Juga</h2>
        <div class="grid grid-3">
            @foreach ($more as $ar)
                @include('partials.article_card', ['ar' => $ar])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
