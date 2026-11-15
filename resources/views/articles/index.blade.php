@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Artikel & Cerita</h1>
        <p>Cerita, tips, dan wawasan dari komunitas Halowan.id.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if ($articles->isNotEmpty())
            <div class="grid grid-3">
                @foreach ($articles as $ar)
                    @include('partials.article_card', ['ar' => $ar])
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada artikel.</p>
        @endif
    </div>
</section>
@endsection
