@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Forum Diskusi</h1>
        <p>Tanya, jawab, dan berbagi pengalaman dengan sesama anggota komunitas.</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <div class="section-head">
            <h2>Topik Terbaru</h2>
            @auth
                <a class="btn btn-primary" href="{{ route('forum.create') }}">+ Topik Baru</a>
            @else
                <a class="btn btn-outline" href="{{ route('login') }}">Masuk untuk membuat topik</a>
            @endauth
        </div>
        @include('partials.topic_list', ['topics' => $topics])
    </div>
</section>
@endsection
