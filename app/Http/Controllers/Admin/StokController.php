<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukBouquet;
use App\Models\StokProduk;
use App\Services\StokService;
use Illuminate\Http\Request;

class StokController extends Controller
{
    protected StokService $stokService;

    public function __construct(StokService $stokService)
    {
        $this->stokService = $stokService;
    }

    public function index(Request $request)
    {
        $query = StokProduk::with(['produk', 'pengguna'])->orderBy('tanggal_perubahan', 'desc');

        if ($request->filled('id_produk')) {
            $query->where('id_produk', $request->id_produk);
        }

        $riwayatStok = $query->paginate(20);
        $produks = ProdukBouquet::orderBy('nama_produk')->get();

        return view('admin.pages.stok.index', compact('riwayatStok', 'produks'));
    }

    public function create()
    {
        $produks = ProdukBouquet::orderBy('nama_produk')->get();
        return view('admin.pages.stok.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk_bouquet,id_produk',
            'jenis_perubahan' => 'required|in:masuk,keluar,penyesuaian',
            'jumlah' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $produk = ProdukBouquet::findOrFail($request->id_produk);

        try {
            $this->stokService->catatStok(
                $produk, 
                $request->jenis_perubahan, 
                $request->jumlah, 
                $request->keterangan
            );

            return redirect()->route('admin.stok.index')
                ->with('success', 'Perubahan stok berhasil dicatat.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
