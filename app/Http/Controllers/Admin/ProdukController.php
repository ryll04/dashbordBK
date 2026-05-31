<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukBouquet;
use App\Models\KategoriBouquet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = ProdukBouquet::with('kategori')->orderBy('nama_produk')->get();
        return view('admin.pages.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = KategoriBouquet::where('status_kategori', 'aktif')->orderBy('nama_kategori')->get();
        return view('admin.pages.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_bouquet,id_kategori',
            'nama_produk' => 'required|string|max:150',
            'deskripsi_produk' => 'nullable|string',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk' => 'required|integer|min:0',
            'batas_stok_rendah' => 'required|integer|min:1',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status_produk' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto_produk')) {
            $path = $request->file('foto_produk')->store('produk', 'public');
            $validated['foto_produk'] = $path;
        }

        ProdukBouquet::create($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(ProdukBouquet $produk)
    {
        $kategoris = KategoriBouquet::where('status_kategori', 'aktif')
                    ->orWhere('id_kategori', $produk->id_kategori)
                    ->orderBy('nama_kategori')
                    ->get();
                    
        return view('admin.pages.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, ProdukBouquet $produk)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_bouquet,id_kategori',
            'nama_produk' => 'required|string|max:150',
            'deskripsi_produk' => 'nullable|string',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk' => 'required|integer|min:0',
            'batas_stok_rendah' => 'required|integer|min:1',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status_produk' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $path = $request->file('foto_produk')->store('produk', 'public');
            $validated['foto_produk'] = $path;
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(ProdukBouquet $produk)
    {
        if ($produk->detailTransaksi()->count() > 0) {
            return back()->with('error', 'Produk tidak dapat dihapus karena sudah ada di data transaksi.');
        }

        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
