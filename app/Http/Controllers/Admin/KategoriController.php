<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBouquet;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = KategoriBouquet::orderBy('nama_kategori')->get();
        return view('admin.pages.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.pages.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_bouquet',
            'deskripsi_kategori' => 'nullable|string',
            'status_kategori' => 'required|in:aktif,nonaktif',
        ]);

        KategoriBouquet::create($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriBouquet $kategori)
    {
        return view('admin.pages.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriBouquet $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_bouquet,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            'deskripsi_kategori' => 'nullable|string',
            'status_kategori' => 'required|in:aktif,nonaktif',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriBouquet $kategori)
    {
        if ($kategori->produk()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
