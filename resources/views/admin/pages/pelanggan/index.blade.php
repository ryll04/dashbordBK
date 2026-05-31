@extends('admin.layouts.app')

@section('title', 'Pelanggan')
@section('header', 'Pelanggan')

@section('content')
<div class="flex justify-between items-center" style="margin-bottom: var(--space-xl);">
    <h2 class="text-heading-md" style="margin: 0;">Daftar Pelanggan</h2>
    <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary">+ Tambah Pelanggan</a>
</div>

<div class="card pin-card" style="padding: 0;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Nama</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Nomor Telepon</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Alamat</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Jenis</th>
                <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggans as $p)
            <tr style="border-bottom: 1px solid var(--color-hairline);">
                <td style="padding: var(--space-md) var(--space-lg); font-weight: 500;">{{ $p->nama_pelanggan }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">{{ $p->nomor_telepon }}</td>
                <td style="padding: var(--space-md) var(--space-lg); color: var(--color-mute);">{{ Str::limit($p->alamat, 40) }}</td>
                <td style="padding: var(--space-md) var(--space-lg);">
                    <span style="display: inline-block; padding: 2px 8px; border-radius: var(--radius-full); font-size: 12px; font-weight: 600; background-color: {{ $p->jenis_pelanggan == 'lama' ? 'var(--color-success-pale)' : 'var(--color-secondary-bg)' }}; color: {{ $p->jenis_pelanggan == 'lama' ? 'var(--color-success-deep)' : 'var(--color-ink)' }};">
                        {{ ucfirst($p->jenis_pelanggan) }}
                    </span>
                </td>
                <td style="padding: var(--space-md) var(--space-lg); text-align: right;">
                    <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-secondary" style="height: 32px; padding: 0 10px;">Edit</a>
                    <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" style="height: 32px; padding: 0 10px; color: var(--color-error);">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Tidak ada data pelanggan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
