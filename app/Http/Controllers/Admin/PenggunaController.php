<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::orderBy('nama_lengkap')->get();
        return view('admin.pages.pengguna.index', compact('penggunas'));
    }

    public function create()
    {
        return view('admin.pages.pengguna.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:pengguna,email',
            'password' => 'required|string|min:6',
            'peran' => 'required|in:admin,staf',
            'nomor_hp' => 'nullable|string|max:20',
            'status_aktif' => 'required|in:aktif,nonaktif',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Pengguna::create($validated);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(Pengguna $pengguna)
    {
        return view('admin.pages.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => [
                'required', 'email', 'max:100',
                Rule::unique('pengguna')->ignore($pengguna->id_pengguna, 'id_pengguna')
            ],
            'peran' => 'required|in:admin,staf',
            'nomor_hp' => 'nullable|string|max:20',
            'status_aktif' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $validated['password'] = Hash::make($request->password);
        }

        $pengguna->update($validated);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Pengguna $pengguna)
    {
        if ($pengguna->id_pengguna == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($pengguna->transaksi()->count() > 0) {
            // Soft delete or just disable
            $pengguna->update(['status_aktif' => 'nonaktif']);
            return redirect()->route('admin.pengguna.index')
                ->with('success', 'Pengguna memiliki riwayat transaksi, statusnya diubah menjadi nonaktif.');
        }

        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
