@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <a class="back" href="{{ route('forum.index') }}">&larr; Kembali ke forum</a>
        <h1>Buat Topik Baru</h1>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <form class="form card card-body" method="post" action="{{ route('forum.store') }}">
            @csrf
            <div class="field">
                <label for="judul">Judul</label>
                <input id="judul" name="judul" type="text" maxlength="150" required autofocus value="{{ old('judul') }}" placeholder="Apa yang ingin kamu diskusikan?">
            </div>
            <div class="field">
                <label for="isi">Isi diskusi</label>
                <textarea id="isi" name="isi" rows="8" maxlength="5000" required placeholder="Tuliskan latar belakang atau pertanyaanmu secara jelas...">{{ old('isi') }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Terbitkan</button>
        </form>
    </div>
</section>
@endsection
