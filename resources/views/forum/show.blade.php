@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <a class="back" href="{{ route('forum.index') }}">&larr; Semua topik</a>
        <h1>{{ $topic->judul }}</h1>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <article class="card card-body post">
            <header class="post-head">
                {!! avatar($topic->user, 'avatar-sm') !!}
                <div>
                    <a href="{{ route('members.profile', $topic->user_id) }}"><b>{{ $topic->penulis }}</b></a>
                    <span class="meta">{{ tanggal($topic->created_at, true) }}</span>
                </div>
            </header>
            <div class="prose">{!! nl2br(e($topic->isi)) !!}</div>
        </article>

        <h2 id="komentar" class="comments-title">{{ $comments->count() }} Komentar</h2>

        @foreach ($comments as $c)
            <div class="comment">
                {!! avatar($c->user, 'avatar-sm') !!}
                <div class="comment-body">
                    <p class="comment-meta">
                        <a href="{{ route('members.profile', $c->user_id) }}"><b>{{ $c->penulis }}</b></a>
                        <span class="meta">{{ tanggal($c->created_at, true) }}</span>
                    </p>
                    <p>{!! nl2br(e($c->isi)) !!}</p>
                </div>
            </div>
        @endforeach

        @auth
            <form class="form card card-body" method="post" action="{{ route('forum.comment', $topic->id) }}">
                @csrf
                <div class="field">
                    <label for="isi">Tulis komentar</label>
                    <textarea id="isi" name="isi" rows="4" maxlength="2000" required placeholder="Tuliskan tanggapan Anda..."></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Kirim Komentar</button>
            </form>
        @else
            <p class="empty"><a href="{{ route('login') }}">Masuk</a> untuk ikut berkomentar.</p>
        @endauth
    </div>
</section>
@endsection
