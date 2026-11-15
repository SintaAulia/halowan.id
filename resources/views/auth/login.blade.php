@extends('layouts.main')

@section('content')
<section class="section auth">
    <div class="container narrow-sm">
        <div class="card card-body">
            <h1>Masuk</h1>
            <p class="muted">Selamat datang kembali di Halowan.id.</p>
            <form class="form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required autofocus value="{{ old('email') }}">
                </div>
                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Masuk</button>
            </form>
            <p class="auth-alt">Belum punya akun? <a href="{{ route('register') }}">Gabung sekarang</a></p>
        </div>
    </div>
</section>
@endsection
