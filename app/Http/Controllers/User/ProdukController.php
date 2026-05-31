<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProdukBouquet;
use App\Models\KategoriBouquet;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoriId = $request->input('kategori');
        $search = $request->input('search');

        $query = ProdukBouquet::with('kategori')->where('status_produk', 'aktif');

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        if ($search) {
            $query->where('nama_produk', 'like', "%{$search}%");
        }

        $produks = $query->orderBy('nama_produk')->paginate(12);
        $kategoris = KategoriBouquet::where('status_kategori', 'aktif')->orderBy('nama_kategori')->get();

        return view('user.pages.produk.index', compact('produks', 'kategoris', 'kategoriId', 'search'));
    }
}
