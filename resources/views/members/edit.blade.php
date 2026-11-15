@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <h1>Pengaturan Akun</h1>
        <p>{{ $member->email }}</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <form class="form card card-body" method="post" action="{{ route('account.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="field avatar-field">
                {!! avatar($member, 'avatar-lg') !!}
                <div>
                    <label for="avatar">Foto profil</label>
                    <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/webp,image/gif">
                    <small class="hint">JPG, PNG, WEBP, atau GIF. Maksimal 2 MB.</small>
                </div>
            </div>
            <div class="field">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" maxlength="60" required value="{{ old('nama', $member->name) }}">
            </div>
            <div class="field">
                <label for="bio">Bio singkat</label>
                <textarea id="bio" name="bio" rows="4" maxlength="300" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('bio', $member->bio) }}</textarea>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                <a class="btn btn-outline" href="{{ route('members.profile', $member->id) }}">Lihat Profil</a>
            </div>
        </form>
    </div>
</section>
@endsection
