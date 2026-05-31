@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0;">Daftar Akun Karyawan</h2>
    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">+ Tambah Pengguna</a>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Nama</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Email</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Peran</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Status</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penggunas as $p)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 500;">{{ $p->nama_lengkap }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $p->email }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <span style="font-weight: 600; color: {{ $p->peran == 'admin' ? 'var(--color-primary)' : 'var(--color-ink)' }};">
                        {{ ucfirst($p->peran) }}
                    </span>
                </td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <span style="display: inline-block; padding: 2px 8px; border-radius: var(--radius-full); font-size: 12px; font-weight: 600; background-color: {{ $p->status_aktif == 'aktif' ? 'var(--color-success-pale)' : 'var(--color-secondary-bg)' }}; color: {{ $p->status_aktif == 'aktif' ? 'var(--color-success-deep)' : 'var(--color-ink)' }};">
                        {{ ucfirst($p->status_aktif) }}
                    </span>
                </td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right;">
                    <a href="{{ route('admin.pengguna.edit', $p->id_pengguna) }}" class="btn btn-secondary" style="height: 32px; padding: 0 10px;">Edit</a>
                    <form action="{{ route('admin.pengguna.destroy', $p->id_pengguna) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus / menonaktifkan pengguna ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" style="height: 32px; padding: 0 10px; color: var(--color-error);" {{ $p->id_pengguna == auth()->id() ? 'disabled' : '' }}>Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada data pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
