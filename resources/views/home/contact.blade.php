@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Kontak Kami</h1>
        <p>Ada pertanyaan, saran, atau ide kolaborasi? Tulis saja di sini.</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <form class="form card card-body" method="post" action="{{ route('contact.send') }}">
            @csrf
            <div class="field">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" maxlength="80" required value="{{ old('nama', auth()->user()?->name) }}">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" maxlength="120" required value="{{ old('email', auth()->user()?->email) }}">
            </div>
            <div class="field">
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" rows="6" maxlength="2000" required>{{ old('pesan') }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Kirim Pesan</button>
        </form>
    </div>
</section>
@endsection
