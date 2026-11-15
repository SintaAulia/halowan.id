@extends('layouts.admin')

@section('content')
<header class="admin-head">
    <h1>Kelola Anggota</h1>
</header>

<div class="table-wrap">
    <table class="table">
        <thead><tr><th>Nama</th><th>Email</th><th>Peran</th><th>Bergabung</th><th></th></tr></thead>
        <tbody>
        @foreach ($users as $u)
            @php $self = $u->id === auth()->id(); @endphp
            <tr>
                <td>{{ $u->name }} @if ($self) <span class="badge">Kamu</span> @endif</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge {{ $u->role === 'admin' ? '' : 'badge-muted' }}">{{ $u->role }}</span></td>
                <td>{{ tanggal($u->created_at) }}</td>
                <td class="actions">
                    @if (!$self)
                        <form method="post" action="{{ route('admin.users.role', $u->id) }}" onsubmit="return confirm('Ubah peran {{ $u->name }}?')">
                            @csrf
                            <button class="btn btn-sm btn-outline" type="submit">{{ $u->role === 'admin' ? 'Jadikan member' : 'Jadikan admin' }}</button>
                        </form>
                        <form method="post" action="{{ route('admin.users.delete', $u->id) }}" onsubmit="return confirm('Hapus anggota {{ $u->name }} beserta datanya?')">
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
