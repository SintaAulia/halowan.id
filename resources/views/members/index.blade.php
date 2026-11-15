@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Anggota Komunitas</h1>
        <p>{{ $members->count() }} orang sudah bergabung di Halowan.id.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if ($members->isNotEmpty())
            <div class="grid grid-4">
                @foreach ($members as $m)
                    <a class="card card-body member" href="{{ route('members.profile', $m->id) }}">
                        {!! avatar($m, 'avatar-lg') !!}
                        <h3>{{ $m->name }}</h3>
                        @if ($m->isAdmin())
                            <span class="badge">Pengelola</span>
                        @endif
                        <p class="meta">{{ $m->bio ? Str::limit($m->bio, 70) : 'Anggota sejak ' . tanggal($m->created_at) }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada anggota.</p>
        @endif
    </div>
</section>
@endsection
