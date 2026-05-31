@extends('user.layouts.app')

@section('title', 'Profil Saya')
@section('header', 'Profil Akun')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: var(--space-xl);">
        <div style="width: 80px; height: 80px; background-color: var(--color-surface-soft); border-radius: 50%; margin: 0 auto var(--space-md) auto; display: flex; align-items: center; justify-content: center; font-size: 32px;">
            👤
        </div>
        <h2 class="text-heading-md" style="margin: 0;">{{ $user->nama_lengkap }}</h2>
        <div class="text-caption" style="color: var(--color-primary); font-weight: 600;">{{ strtoupper($user->peran) }}</div>
    </div>

    <div style="display: grid; grid-template-columns: 100px 1fr; gap: var(--space-md); margin-bottom: var(--space-lg); border-top: 1px solid var(--color-hairline); padding-top: var(--space-lg);">
        <div class="text-body-strong" style="color: var(--color-mute);">Email</div>
        <div style="font-weight: 500;">{{ $user->email }}</div>
        
        <div class="text-body-strong" style="color: var(--color-mute);">No. HP</div>
        <div style="font-weight: 500;">{{ $user->nomor_hp ?? '-' }}</div>
        
        <div class="text-body-strong" style="color: var(--color-mute);">Bergabung</div>
        <div style="font-weight: 500;">{{ $user->created_at->format('d F Y') }}</div>
        
        <div class="text-body-strong" style="color: var(--color-mute);">Status</div>
        <div>
            <span style="display: inline-block; padding: 2px 8px; border-radius: var(--radius-full); font-size: 12px; font-weight: 600; background-color: var(--color-success-pale); color: var(--color-success-deep);">
                {{ ucfirst($user->status_aktif) }}
            </span>
        </div>
    </div>
</div>
@endsection
