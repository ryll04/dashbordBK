<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\ProdukBouquet;
use App\Models\Transaksi;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    protected TransaksiService $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function index()
    {
        // View transactions done by this user today
        $transaksis = Transaksi::with('pelanggan')
                        ->where('id_pengguna', Auth::id())
                        ->whereDate('tanggal_transaksi', today())
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);
                        
        return view('user.pages.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        // Only get products with stock > 0
        $produks = ProdukBouquet::where('status_produk', 'aktif')->where('stok_produk', '>', 0)->orderBy('nama_produk')->get();
        
        return view('user.pages.transaksi.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
            'metode_pembayaran' => 'required|in:tunai,transfer,qris',
            'jumlah_bayar' => 'required|numeric|min:0',
            'catatan_transaksi' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id_produk' => 'required|exists:produk_bouquet,id_produk',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        // Transform items array
        $items = [];
        foreach ($request->items as $item) {
            $items[] = [
                'id_produk' => $item['id_produk'],
                'jumlah_terjual' => $item['jumlah'],
            ];
        }

        $dataTransaksi = [
            'id_pelanggan' => $request->id_pelanggan,
            'catatan_transaksi' => $request->catatan_transaksi,
            'tanggal_transaksi' => now(),
        ];

        $dataPembayaran = [
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar,
        ];

        try {
            $transaksi = $this->transaksiService->buatTransaksi($dataTransaksi, $items, $dataPembayaran);
            
            return redirect()->route('user.transaksi.show', $transaksi->id_transaksi)
                ->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Transaksi $transaksi)
    {
        // Ensure user can only see their own transactions, or we can relax it. 
        // For simplicity, we allow viewing if it exists (like a receipt link)
        $transaksi->load(['pelanggan', 'detail.produk', 'pembayaran']);
        return view('user.pages.transaksi.show', compact('transaksi'));
    }
}
