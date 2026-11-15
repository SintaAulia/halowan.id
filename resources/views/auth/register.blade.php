@extends('layouts.main')

@section('content')
<section class="section auth">
    <div class="container narrow-sm">
        <div class="card card-body">
            <h1>Gabung Komunitas</h1>
            <p class="muted">Gratis dan hanya butuh satu menit.</p>
            <form class="form" method="post" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <label for="nama">Nama lengkap</label>
                    <input id="nama" name="nama" type="text" autocomplete="name" maxlength="60" required autofocus value="{{ old('nama') }}">
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" maxlength="120" required value="{{ old('email') }}">
                </div>
                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" required>
                    <small class="hint">Minimal 8 karakter.</small>
                </div>
                <div class="field">
                    <label for="password_confirmation">Ulangi kata sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="8" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Buat Akun</button>
            </form>
            <p class="auth-alt">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
    </div>
</section>
@endsection
