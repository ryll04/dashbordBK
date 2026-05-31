<section class="section" id="rancangan">
    <div class="section-header">
      <div class="section-number">14</div>
      <div class="section-title">
        <h2>Rancangan Layar Dashboard</h2>
        <p>Mockup tampilan dashboard yang dirancang agar informasi dapat disajikan secara visual, menarik, dan mudah dipahami oleh pengguna.</p>
      </div>
    </div>
 
    <div class="dashboard-mockup">
      <div class="db-header">
        <div class="db-header-dot"></div>
        <div class="db-header-dot"></div>
        <div class="db-header-dot"></div>
        <span>🌸 Dashboard UMKM Bouquet Bunga — Mei 2025</span>
      </div>
      <div class="db-body">
 
        <!-- Summary Row -->
        <div class="summary-row">
          <div class="sum-card">
            <div class="lbl">📦 Total Penjualan</div>
            <div class="val" style="color: var(--pink-800)">1.248</div>
            <div class="chg up">▲ 18% vs bulan lalu</div>
          </div>
          <div class="sum-card">
            <div class="lbl">💰 Total Pendapatan</div>
            <div class="val" style="color: var(--green-800)">Rp 48,6 Jt</div>
            <div class="chg up">▲ 23% vs bulan lalu</div>
          </div>
          <div class="sum-card">
            <div class="lbl">🧾 Jumlah Transaksi</div>
            <div class="val" style="color: var(--purple-800)">387</div>
            <div class="chg up">▲ 12% vs bulan lalu</div>
          </div>
          <div class="sum-card">
            <div class="lbl">👥 Jumlah Pelanggan</div>
            <div class="val" style="color: var(--teal-800)">219</div>
            <div class="chg up">▲ 8% vs bulan lalu</div>
          </div>
        </div>
 
        <!-- Chart Row -->
        <div class="chart-row">
          <div class="chart-box">
            <div class="ch-title">📈 Grafik Penjualan Bulanan (Jan–Jun)</div>
            <div class="bar-chart">
              <div class="bar-group">
                <div class="bar" style="height:52px;background:linear-gradient(to top,#D81B60,#F06292)"></div>
                <div class="bar-lbl">Jan</div>
              </div>
              <div class="bar-group">
                <div class="bar" style="height:41px;background:linear-gradient(to top,#D81B60,#F06292)"></div>
                <div class="bar-lbl">Feb</div>
              </div>
              <div class="bar-group">
                <div class="bar" style="height:63px;background:linear-gradient(to top,#880E4F,#D81B60)"></div>
                <div class="bar-lbl">Mar</div>
              </div>
              <div class="bar-group">
                <div class="bar" style="height:55px;background:linear-gradient(to top,#D81B60,#F06292)"></div>
                <div class="bar-lbl">Apr</div>
              </div>
              <div class="bar-group">
                <div class="bar" style="height:78px;background:linear-gradient(to top,#880E4F,#D81B60);border:2px solid #FFD6E7"></div>
                <div class="bar-lbl" style="color: var(--pink-600); font-weight:700">Mei ▲</div>
              </div>
              <div class="bar-group">
                <div class="bar" style="height:35px;background:#FFD6E7;border:1px dashed #F06292"></div>
                <div class="bar-lbl" style="color:var(--gray-400)">Jun*</div>
              </div>
            </div>
            <div style="font-size:10px;color:var(--gray-400);margin-top:6px">*Jun = proyeksi</div>
          </div>
          <div class="chart-box">
            <div class="ch-title">🏆 Produk Terlaris</div>
            <div class="donut-wrap">
              <svg width="72" height="72" viewBox="0 0 72 72">
                <circle cx="36" cy="36" r="28" fill="none" stroke="#F0F0F0" stroke-width="10"/>
                <circle cx="36" cy="36" r="28" fill="none" stroke="#D81B60" stroke-width="10" stroke-dasharray="70 106" stroke-dashoffset="-79" transform="rotate(-90 36 36)"/>
                <circle cx="36" cy="36" r="28" fill="none" stroke="#F06292" stroke-width="10" stroke-dasharray="40 136" stroke-dashoffset="-9" transform="rotate(-90 36 36)"/>
                <circle cx="36" cy="36" r="28" fill="none" stroke="#880E4F" stroke-width="10" stroke-dasharray="26 150" stroke-dashoffset="-49" transform="rotate(-90 36 36)"/>
                <circle cx="36" cy="36" r="28" fill="none" stroke="#FFCDD2" stroke-width="10" stroke-dasharray="20 156" stroke-dashoffset="-75" transform="rotate(-90 36 36)"/>
              </svg>
              <div class="donut-legend">
                <div class="legend-item"><div class="legend-dot" style="background:#D81B60"></div>Bouquet Wisuda 40%</div>
                <div class="legend-item"><div class="legend-dot" style="background:#F06292"></div>Bouquet Snack 23%</div>
                <div class="legend-item"><div class="legend-dot" style="background:#880E4F"></div>Buket Mawar 15%</div>
                <div class="legend-item"><div class="legend-dot" style="background:#FFCDD2"></div>Lainnya 22%</div>
              </div>
            </div>
          </div>
        </div>
 
        <!-- Table -->
        <div class="table-box">
          <table>
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Pelanggan</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>28 Mei</td><td>Bouquet Wisuda Premium</td><td>Siti Rahayu</td><td>2</td><td>Rp 320.000</td><td><span class="badge badge-green">Lunas</span></td></tr>
              <tr><td>27 Mei</td><td>Bouquet Snack Ulang Tahun</td><td>Budi Santoso</td><td>1</td><td>Rp 145.000</td><td><span class="badge badge-green">Lunas</span></td></tr>
              <tr><td>26 Mei</td><td>Buket Mawar Merah</td><td>Dewi Lestari</td><td>3</td><td>Rp 210.000</td><td><span class="badge badge-amber">DP</span></td></tr>
              <tr><td>25 Mei</td><td>Bouquet Wisuda Mini</td><td>Rini Wulandari</td><td>5</td><td>Rp 625.000</td><td><span class="badge badge-green">Lunas</span></td></tr>
              <tr><td>24 Mei</td><td>Buket Pernikahan</td><td>Andi Pratama</td><td>1</td><td>Rp 480.000</td><td><span class="badge badge-red">Belum</span></td></tr>
            </tbody>
          </table>
        </div>
 
        <!-- Stok Warning -->
        <div style="margin-top:16px; background: #FFF8E1; border: 1px solid var(--amber-100); border-left: 3px solid var(--amber-600); border-radius: 10px; padding: 12px 16px;">
          <div style="font-size:12px; font-weight:700; color:var(--amber-800); margin-bottom:8px">⚠️ Peringatan Stok Kritis</div>
          <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <span style="background:white;border:1px solid var(--amber-100);border-radius:8px;padding:4px 10px;font-size:12px;color:var(--amber-800)">🌹 Mawar Merah – 3 tangkai</span>
            <span style="background:white;border:1px solid var(--amber-100);border-radius:8px;padding:4px 10px;font-size:12px;color:var(--amber-800)">🎀 Pita Satin – 2 rol</span>
            <span style="background:#FFEBEE;border:1px solid #FFCDD2;border-radius:8px;padding:4px 10px;font-size:12px;color:#B71C1C">🌿 Daun Fern – HABIS</span>
          </div>
        </div>
 
      </div>
    </div>
 
    <!-- Komponen legend -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;margin-top:20px">
      <div style="background:white;border:1px solid var(--gray-200);border-radius:12px;padding:14px">
        <div style="font-size:12px;font-weight:700;color:var(--pink-600);margin-bottom:6px">📊 Ringkasan Utama</div>
        <div style="font-size:12px;color:var(--gray-600)">Summary cards menampilkan KPI bisnis secara sekilas dengan perbandingan periode sebelumnya.</div>
      </div>
      <div style="background:white;border:1px solid var(--gray-200);border-radius:12px;padding:14px">
        <div style="font-size:12px;font-weight:700;color:var(--green-600);margin-bottom:6px">📈 Grafik Tren</div>
        <div style="font-size:12px;color:var(--gray-600)">Bar chart penjualan bulanan membantu visualisasi naik/turun performa bisnis per periode.</div>
      </div>
      <div style="background:white;border:1px solid var(--gray-200);border-radius:12px;padding:14px">
        <div style="font-size:12px;font-weight:700;color:var(--purple-600);margin-bottom:6px">🥧 Produk Terlaris</div>
        <div style="font-size:12px;color:var(--gray-600)">Donut chart menampilkan distribusi penjualan per produk secara proporsi yang mudah dibaca.</div>
      </div>
      <div style="background:white;border:1px solid var(--gray-200);border-radius:12px;padding:14px">
        <div style="font-size:12px;font-weight:700;color:var(--teal-600);margin-bottom:6px">📋 Tabel Transaksi</div>
        <div style="font-size:12px;color:var(--gray-600)">Detail transaksi terbaru dengan status pembayaran untuk tracking operasional harian.</div>
      </div>
      <div style="background:white;border:1px solid var(--gray-200);border-radius:12px;padding:14px">
        <div style="font-size:12px;font-weight:700;color:var(--amber-600);margin-bottom:6px">⚠️ Alert Stok</div>
        <div style="font-size:12px;color:var(--gray-600)">Notifikasi otomatis ketika stok bahan/produk mendekati atau sudah mencapai batas minimum.</div>
      </div>
    </div>
 
    <div class="key-point">
      🎯 Desain dashboard harus <strong>sederhana, informatif, dan interaktif</strong> — memudahkan pemilik UMKM membaca performa bisnis dalam satu layar.
    </div>
  </section>
 
  <!-- ====== 15. INSIGHT ====== -->
  <section class="section" id="insight">
    <div class="section-header">
      <div class="section-number">15</div>
      <div class="section-title">
        <h2>Contoh Insight dari Dashboard</h2>
        <p>Insight adalah informasi penting berbasis data yang diperoleh dari hasil analisis dashboard untuk mendukung pengambilan keputusan bisnis.</p>
      </div>
    </div>
 
    <div class="insight-grid">
 
      <div class="insight-card" style="border-top: 3px solid var(--pink-600)">
        <div>
          <span class="insight-tag" style="background:var(--pink-100);color:var(--pink-800)">🎓 Musiman</span>
        </div>
        <h4>Bouquet wisuda melonjak saat musim kelulusan</h4>
        <p>Penjualan Bouquet Wisuda meningkat <strong>340%</strong> pada bulan April–Juni. Jadwal panen penjualan bersamaan dengan pengumuman wisuda kampus-kampus besar.</p>
        <div style="background:var(--pink-50);border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:var(--pink-800);font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:var(--pink-700)">Siapkan stok 3× lebih banyak mulai Maret. Buat paket bundling wisuda dengan harga spesial.</div>
        </div>
        <span class="insight-action" style="background:var(--pink-100);color:var(--pink-800)">→ Strategi Stok Musiman</span>
      </div>
 
      <div class="insight-card" style="border-top: 3px solid var(--amber-600)">
        <div>
          <span class="insight-tag" style="background:var(--amber-100);color:var(--amber-800)">📅 Pola Mingguan</span>
        </div>
        <h4>Penjualan meningkat signifikan di akhir pekan</h4>
        <p>Sabtu dan Minggu menghasilkan <strong>68% dari total penjualan mingguan</strong>. Hari Sabtu pukul 10.00–14.00 adalah peak hour tertinggi.</p>
        <div style="background:var(--amber-50);border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:var(--amber-800);font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:var(--amber-700)">Siapkan staf tambahan akhir pekan. Jalankan promosi flash sale Jumat malam untuk pesan lebih awal.</div>
        </div>
        <span class="insight-action" style="background:var(--amber-100);color:var(--amber-800)">→ Optimasi Jadwal Operasional</span>
      </div>
 
      <div class="insight-card" style="border-top: 3px solid var(--purple-600)">
        <div>
          <span class="insight-tag" style="background:var(--purple-100);color:var(--purple-800)">👧 Demografi</span>
        </div>
        <h4>Bouquet snack sangat diminati segmen remaja</h4>
        <p>Pelanggan usia <strong>15–24 tahun</strong> membeli Bouquet Snack sebesar 78% dari total penjualan produk ini, terutama untuk hadiah ulang tahun teman sebaya.</p>
        <div style="background:var(--purple-50);border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:var(--purple-800);font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:var(--purple-700)">Optimalkan marketing di TikTok & Instagram. Buat varian baru dengan snack kekinian untuk segmen ini.</div>
        </div>
        <span class="insight-action" style="background:var(--purple-100);color:var(--purple-800)">→ Strategi Marketing Digital</span>
      </div>
 
      <div class="insight-card" style="border-top: 3px solid var(--green-600)">
        <div>
          <span class="insight-tag" style="background:var(--green-100);color:var(--green-800)">💰 Revenue</span>
        </div>
        <h4>Pendapatan tertinggi terjadi saat event spesial</h4>
        <p>Hari Valentine, Hari Ibu, dan Ulang Tahun Kota menghasilkan <strong>Rp 12–18 Jt per event</strong> — setara 30% pendapatan bulanan hanya dalam 1–2 hari.</p>
        <div style="background:var(--green-50);border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:var(--green-800);font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:var(--green-700)">Buat kalender event tahunan. Pre-order 2 minggu sebelum event dengan bonus gratis pita/kartu ucapan.</div>
        </div>
        <span class="insight-action" style="background:var(--green-100);color:var(--green-800)">→ Kalender Promo Event</span>
      </div>
 
      <div class="insight-card" style="border-top: 3px solid var(--teal-600)">
        <div>
          <span class="insight-tag" style="background:var(--teal-100);color:var(--teal-800)">📦 Inventori</span>
        </div>
        <h4>Produk tertentu jarang dibeli — perlu evaluasi</h4>
        <p><strong>Buket Lavender Kering</strong> hanya terjual 4 unit dalam 3 bulan, sementara biaya bahan baku dan penyimpanan terus berjalan, menggerus margin keuntungan.</p>
        <div style="background:var(--teal-50);border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:var(--teal-800);font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:var(--teal-700)">Jalankan promo diskon khusus atau bundling. Jika tetap tidak laku dalam 1 bulan, hentikan produksi produk ini.</div>
        </div>
        <span class="insight-action" style="background:var(--teal-100);color:var(--teal-800)">→ Evaluasi Portofolio Produk</span>
      </div>
 
      <div class="insight-card" style="border-top: 3px solid #EF5350">
        <div>
          <span class="insight-tag" style="background:#FFEBEE;color:#B71C1C">🔄 Retensi</span>
        </div>
        <h4>42% pelanggan melakukan pembelian berulang</h4>
        <p>Hampir separuh pelanggan kembali membeli dalam <strong>30 hari</strong>, dengan rata-rata 2,4× pembelian per pelanggan loyal — basis repeat buyer yang kuat.</p>
        <div style="background:#FFF3F3;border-radius:10px;padding:10px 14px;margin-top:4px">
          <div style="font-size:11px;color:#B71C1C;font-weight:700;margin-bottom:4px">📌 Rekomendasi Aksi:</div>
          <div style="font-size:12px;color:#C62828">Implementasi program loyalitas: stamp card, poin reward, atau diskon khusus pelanggan setia.</div>
        </div>
        <span class="insight-action" style="background:#FFEBEE;color:#B71C1C">→ Program Loyalitas Pelanggan</span>
      </div>
 
    </div>