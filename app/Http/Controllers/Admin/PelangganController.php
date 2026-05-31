<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        return view('admin.pages.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('admin.pages.pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_pelanggan' => 'required|in:baru,lama',
            'catatan' => 'nullable|string',
        ]);

        Pelanggan::create($validated);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pages.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'jenis_pelanggan' => 'required|in:baru,lama',
            'catatan' => 'nullable|string',
        ]);

        $pelanggan->update($validated);

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->transaksi()->count() > 0) {
            return back()->with('error', 'Pelanggan tidak dapat dihapus karena sudah memiliki riwayat transaksi.');
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
