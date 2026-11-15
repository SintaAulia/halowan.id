@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Event Komunitas</h1>
        <p>Kegiatan komunitas untuk belajar, berjejaring, dan bertumbuh bersama.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Akan Datang</h2>
        @if ($upcoming->isNotEmpty())
            <div class="grid grid-3">
                @foreach ($upcoming as $ev)
                    @include('partials.event_card', ['ev' => $ev])
                @endforeach
            </div>
        @else
            <p class="empty">Belum ada event mendatang. Pantau terus ya!</p>
        @endif
    </div>
</section>

@if ($past->isNotEmpty())
<section class="section section-soft">
    <div class="container">
        <h2>Event Sebelumnya</h2>
        <div class="grid grid-3">
            @foreach ($past as $ev)
                @include('partials.event_card', ['ev' => $ev])
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
