<article class="card card-hover">
    <a class="card-media" href="{{ route('articles.show', $ar->slug) }}" tabindex="-1" aria-hidden="true">
        @if ($ar->gambar)
            <img src="{{ media_url($ar->gambar) }}" alt="" loading="lazy">
        @else
            <div class="media-fallback"><span>Artikel</span></div>
        @endif
    </a>
    <div class="card-body">
        <p class="meta">{{ tanggal($ar->created_at) }}{{ $ar->penulis ? ' · ' . $ar->penulis : '' }}</p>
        <h3><a href="{{ route('articles.show', $ar->slug) }}">{{ $ar->judul }}</a></h3>
        <p>{{ Str::limit(strip_tags($ar->isi), 120) }}</p>
    </div>
</article>
