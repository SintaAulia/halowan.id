<article class="card card-hover">
    <a class="card-media" href="{{ route('events.show', $ev->slug) }}" tabindex="-1" aria-hidden="true">
        @if ($ev->banner)
            <img src="{{ media_url($ev->banner) }}" alt="" loading="lazy">
        @else
            <div class="media-fallback"><span>Halowan</span></div>
        @endif
        <span class="date-badge">
            <b>{{ $ev->tanggal->format('j') }}</b>
            <small>{{ $ev->tanggal->format('M') }}</small>
        </span>
    </a>
    <div class="card-body">
        <h3><a href="{{ route('events.show', $ev->slug) }}">{{ $ev->judul }}</a></h3>
        <p class="meta">{{ tanggal($ev->tanggal, true) }}</p>
        <p class="meta">📍 {{ $ev->lokasi }}</p>
        <p>{{ Str::limit(strip_tags($ev->deskripsi), 100) }}</p>
        <p class="meta">{{ $ev->peserta ?? $ev->participants()->count() }} peserta terdaftar</p>
    </div>
</article>
