@extends('user.layouts.app')

@section('title', 'Point of Sales (POS)')
@section('header', 'Point of Sales (POS)')

@section('content')
<form action="{{ route('user.transaksi.store') }}" method="POST" id="pos-form">
    @csrf
    
    <div class="flex gap-lg">
        <!-- Bagian Kiri: Form & Daftar Item -->
        <div style="flex: 2;">
            <!-- Pilihan Pelanggan -->
            <div class="card" style="margin-bottom: var(--space-xl);">
                <div class="flex justify-between items-center" style="margin-bottom: var(--space-md);">
                    <h3 class="text-heading-md" style="margin: 0;">Data Pelanggan</h3>
                    <a href="#" class="text-caption" style="color: var(--color-primary); font-weight: 600;">+ Pelanggan Baru</a>
                </div>
                <div>
                    <select name="id_pelanggan" class="form-input" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pl)
                            <option value="{{ $pl->id_pelanggan }}" {{ old('id_pelanggan') == $pl->id_pelanggan ? 'selected' : '' }}>
                                {{ $pl->nama_pelanggan }} ({{ ucfirst($pl->jenis_pelanggan) }}) - {{ $pl->nomor_telepon }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pelanggan')
                        <div style="color: var(--color-error); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tambah Item -->
            <div class="card pin-card" style="margin-bottom: var(--space-xl); padding: 0;">
                <div style="padding: var(--space-lg); border-bottom: 1px solid var(--color-hairline); background-color: var(--color-surface-soft);">
                    <div class="flex gap-md">
                        <div style="flex: 1;">
                            <select id="produk-selector" class="form-input">
                                <option value="">Pilih Produk (Tersedia)...</option>
                                @foreach($produks as $p)
                                    <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_produk }}" data-nama="{{ $p->nama_produk }}" data-stok="{{ $p->stok_produk }}">
                                        {{ $p->nama_produk }} - Rp {{ number_format($p->harga_produk, 0, ',', '.') }} (Stok: {{ $p->stok_produk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="btn-add-item">Tambah</button>
                    </div>
                </div>
                
                <table style="width: 100%; border-collapse: collapse; text-align: left;" id="table-items">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--color-hairline);">
                            <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Produk</th>
                            <th style="padding: var(--space-md) var(--space-lg); font-weight: 600;">Harga</th>
                            <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; width: 100px;">Qty</th>
                            <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: right;">Subtotal</th>
                            <th style="padding: var(--space-md) var(--space-lg); font-weight: 600; text-align: center;">Hapus</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <!-- Items will be injected here via JS -->
                        <tr id="empty-cart-row">
                            <td colspan="5" style="padding: var(--space-xl); text-align: center; color: var(--color-mute);">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <label class="form-label" for="catatan_transaksi">Catatan Transaksi (Opsional)</label>
                <textarea id="catatan_transaksi" name="catatan_transaksi" class="form-input" rows="2">{{ old('catatan_transaksi') }}</textarea>
            </div>
        </div>

        <!-- Bagian Kanan: Ringkasan & Pembayaran -->
        <div style="flex: 1;">
            <div class="card" style="position: sticky; top: var(--space-xl);">
                <h3 class="text-heading-md" style="margin-bottom: var(--space-lg); border-bottom: 1px solid var(--color-hairline); padding-bottom: var(--space-sm);">Ringkasan Tagihan</h3>
                
                <div class="flex justify-between items-center" style="margin-bottom: var(--space-sm);">
                    <div class="text-body-strong">Total Item</div>
                    <div id="summary-total-item" style="font-weight: 600;">0</div>
                </div>
                
                <div class="flex justify-between items-center" style="margin-bottom: var(--space-lg); padding-bottom: var(--space-lg); border-bottom: 1px dashed var(--color-hairline);">
                    <div class="text-body-strong">Total Harga</div>
                    <div id="summary-total-harga" style="font-size: 20px; font-weight: 700; color: var(--color-primary);">Rp 0</div>
                </div>

                <div style="margin-bottom: var(--space-md);">
                    <label class="form-label" for="metode_pembayaran">Metode Pembayaran <span style="color: var(--color-error);">*</span></label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="form-input" required>
                        <option value="tunai" {{ old('metode_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>

                <div style="margin-bottom: var(--space-xl);">
                    <label class="form-label" for="jumlah_bayar">Jumlah Uang Diterima (Rp) <span style="color: var(--color-error);">*</span></label>
                    <input type="number" id="jumlah_bayar" name="jumlah_bayar" class="form-input" value="{{ old('jumlah_bayar', 0) }}" required min="0">
                    <div id="kembalian-info" style="margin-top: var(--space-xs); font-size: 14px; font-weight: 600; color: var(--color-success-deep); display: none;">
                        Kembalian: Rp 0
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 48px; font-size: 16px;">Selesaikan Transaksi</button>
                
                @if($errors->any())
                    <div style="margin-top: var(--space-md); padding: var(--space-sm); background-color: #fee2e2; border-radius: var(--radius-sm); border: 1px solid #fca5a5;">
                        <ul style="color: var(--color-error); font-size: 12px; margin: 0; padding-left: 16px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelector = document.getElementById('produk-selector');
        const btnAddItem = document.getElementById('btn-add-item');
        const cartBody = document.getElementById('cart-body');
        const emptyCartRow = document.getElementById('empty-cart-row');
        const summaryTotalItem = document.getElementById('summary-total-item');
        const summaryTotalHarga = document.getElementById('summary-total-harga');
        const inputJumlahBayar = document.getElementById('jumlah_bayar');
        const kembalianInfo = document.getElementById('kembalian-info');

        let cart = [];
        let grandTotal = 0;
        let totalItems = 0;

        // Function to format Rupiah
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID').format(number);
        };

        const updateCartUI = () => {
            // Clear current rows except empty row
            const rows = cartBody.querySelectorAll('tr:not(#empty-cart-row)');
            rows.forEach(r => r.remove());

            grandTotal = 0;
            totalItems = 0;

            if (cart.length === 0) {
                emptyCartRow.style.display = 'table-row';
            } else {
                emptyCartRow.style.display = 'none';
                
                cart.forEach((item, index) => {
                    const subtotal = item.harga * item.jumlah;
                    grandTotal += subtotal;
                    totalItems += item.jumlah;

                    const tr = document.createElement('tr');
                    tr.style.borderBottom = '1px solid var(--color-hairline)';
                    tr.innerHTML = `
                        <td style="padding: var(--space-md) var(--space-lg);">
                            ${item.nama}
                            <input type="hidden" name="items[${index}][id_produk]" value="${item.id}">
                        </td>
                        <td style="padding: var(--space-md) var(--space-lg);">Rp ${formatRupiah(item.harga)}</td>
                        <td style="padding: var(--space-md) var(--space-lg);">
                            <input type="number" name="items[${index}][jumlah]" class="form-input cart-qty" style="padding: 4px; height: 32px;" value="${item.jumlah}" min="1" max="${item.stok}" data-index="${index}">
                        </td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: right; font-weight: 600;">Rp ${formatRupiah(subtotal)}</td>
                        <td style="padding: var(--space-md) var(--space-lg); text-align: center;">
                            <button type="button" class="btn-remove text-caption" style="color: var(--color-error); border: none; background: none; cursor: pointer; text-decoration: underline;" data-index="${index}">Hapus</button>
                        </td>
                    `;
                    cartBody.appendChild(tr);
                });
            }

            summaryTotalItem.textContent = totalItems;
            summaryTotalHarga.textContent = 'Rp ' + formatRupiah(grandTotal);

            // Set default payment if untouched or less than total
            if (inputJumlahBayar.value < grandTotal || cart.length === 1) {
                inputJumlahBayar.value = grandTotal;
            }
            
            calculateKembalian();
        };

        const calculateKembalian = () => {
            const bayar = parseFloat(inputJumlahBayar.value) || 0;
            const kembalian = bayar - grandTotal;
            
            if (kembalian >= 0 && grandTotal > 0) {
                kembalianInfo.style.display = 'block';
                kembalianInfo.textContent = 'Kembalian: Rp ' + formatRupiah(kembalian);
            } else {
                kembalianInfo.style.display = 'none';
            }
        };

        btnAddItem.addEventListener('click', function() {
            if (!productSelector.value) return;

            const selectedOption = productSelector.options[productSelector.selectedIndex];
            const id = selectedOption.value;
            const nama = selectedOption.getAttribute('data-nama');
            const harga = parseFloat(selectedOption.getAttribute('data-harga'));
            const stok = parseInt(selectedOption.getAttribute('data-stok'));

            // Check if already in cart
            const existingIndex = cart.findIndex(i => i.id === id);
            
            if (existingIndex !== -1) {
                if (cart[existingIndex].jumlah < stok) {
                    cart[existingIndex].jumlah += 1;
                } else {
                    alert('Maksimal stok tercapai untuk produk ini!');
                }
            } else {
                cart.push({ id, nama, harga, stok, jumlah: 1 });
            }

            // Reset selector
            productSelector.value = "";
            updateCartUI();
        });

        cartBody.addEventListener('change', function(e) {
            if (e.target.classList.contains('cart-qty')) {
                const index = e.target.getAttribute('data-index');
                let newQty = parseInt(e.target.value);
                const maxStok = cart[index].stok;

                if (newQty < 1) newQty = 1;
                if (newQty > maxStok) {
                    alert('Melebihi stok yang tersedia!');
                    newQty = maxStok;
                }
                
                cart[index].jumlah = newQty;
                updateCartUI();
            }
        });

        cartBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove')) {
                const index = e.target.getAttribute('data-index');
                cart.splice(index, 1);
                updateCartUI();
            }
        });

        inputJumlahBayar.addEventListener('input', calculateKembalian);
    });
</script>
@endsection
