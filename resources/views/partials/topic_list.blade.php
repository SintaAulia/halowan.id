@if ($topics->isEmpty())
    <p class="empty">Belum ada diskusi. Jadilah yang pertama memulai!</p>
@else
<ul class="topic-list">
    @foreach ($topics as $t)
        <li class="topic">
            {!! avatar($t->user, 'avatar-sm') !!}
            <div class="topic-main">
                <a class="topic-title" href="{{ route('forum.show', $t->id) }}">{{ $t->judul }}</a>
                <span class="meta">{{ $t->penulis }} · {{ tanggal($t->created_at) }}</span>
            </div>
            <span class="pill" title="Jumlah komentar">💬 {{ $t->komentar }}</span>
        </li>
    @endforeach
</ul>
@endif
