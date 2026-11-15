@extends('layouts.main')

@section('content')
<section class="page-head">
    <div class="container">
        <a class="back" href="{{ route('home') }}">← Kembali ke Home</a>
        <span class="eyebrow" style="margin-bottom: .6rem;">Dukungan & Donasi Komunitas</span>
        <h1>Dukung Tumbuhnya Halowan.id</h1>
        <p>Setiap kontribusi Anda membantu kami menyelenggarakan event edukasi gratis, merawat infrastruktur komunitas, dan membuka ruang belajar yang inklusif untuk semua.</p>
    </div>
</section>

<section class="section">
    <div class="container donation-grid">
        <!-- Kolom Kiri: Pilihan Nominal, QRIS, Transfer Bank, Transparansi -->
        <div>
            <h2>Pilih Nominal Donasi</h2>
            <p class="muted">Pilih paket dukungan di bawah atau tentukan nominal sendiri sesuai kerelaan hati Anda.</p>

            <div class="donation-tiers" id="tiersList">
                <div class="tier-card" onclick="selectTier(25000, this)">
                    <b>Rp 25.000</b>
                    <span>☕ Kopi Operasional</span>
                </div>
                <div class="tier-card is-selected" onclick="selectTier(50000, this)">
                    <b>Rp 50.000</b>
                    <span>📚 Modul & Event</span>
                </div>
                <div class="tier-card" onclick="selectTier(100000, this)">
                    <b>Rp 100.000</b>
                    <span>🚀 Meetup & Venue</span>
                </div>
                <div class="tier-card" onclick="selectTier(250000, this)">
                    <b>Rp 250.000</b>
                    <span>🌟 Supporter Utama</span>
                </div>
            </div>

            <!-- Kartu QRIS -->
            <div class="qris-card">
                <span class="qris-badge">QRIS NASIONAL — GPN</span>
                <h3 style="margin-bottom: .4rem;">Scan Cepat Lewat Aplikasi Apa Saja</h3>
                <p class="muted" style="font-size: .9rem; margin-bottom: 1.2rem;">Dukungan otomatis terhubung ke semua e-Wallet dan Mobile Banking.</p>

                <div class="qris-img-wrap">
                    <svg width="190" height="190" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="QRIS Halowan.id">
                        <rect x="15" y="15" width="55" height="55" rx="8" fill="#0a1f44"/>
                        <rect x="25" y="25" width="35" height="35" rx="4" fill="#ffffff"/>
                        <rect x="33" y="33" width="19" height="19" rx="2" fill="#04ccff"/>
                        <rect x="130" y="15" width="55" height="55" rx="8" fill="#0a1f44"/>
                        <rect x="140" y="25" width="35" height="35" rx="4" fill="#ffffff"/>
                        <rect x="148" y="33" width="19" height="19" rx="2" fill="#04ccff"/>
                        <rect x="15" y="130" width="55" height="55" rx="8" fill="#0a1f44"/>
                        <rect x="25" y="140" width="35" height="35" rx="4" fill="#ffffff"/>
                        <rect x="33" y="148" width="19" height="19" rx="2" fill="#04ccff"/>
                        <rect x="80" y="20" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="102" y="20" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="80" y="42" width="12" height="12" rx="2" fill="#04ccff"/>
                        <rect x="102" y="42" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="80" y="60" width="34" height="10" rx="2" fill="#0a1f44"/>
                        <rect x="20" y="85" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="42" y="85" width="28" height="12" rx="2" fill="#04ccff"/>
                        <rect x="80" y="85" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="102" y="85" width="22" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="135" y="85" width="12" height="12" rx="2" fill="#04ccff"/>
                        <rect x="160" y="85" width="25" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="75" y="75" width="50" height="50" rx="12" fill="#ffffff" filter="drop-shadow(0 2px 6px rgba(0,0,0,0.15))"/>
                        <rect x="82" y="82" width="36" height="36" rx="8" fill="#04ccff"/>
                        <path d="M93 90v20M93 100h14M107 90v20" stroke="#0a1f44" stroke-width="3" stroke-linecap="round"/>
                        <rect x="20" y="107" width="45" height="10" rx="2" fill="#0a1f44"/>
                        <rect x="135" y="107" width="20" height="10" rx="2" fill="#04ccff"/>
                        <rect x="165" y="107" width="20" height="10" rx="2" fill="#0a1f44"/>
                        <rect x="80" y="135" width="12" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="102" y="135" width="12" height="25" rx="2" fill="#04ccff"/>
                        <rect x="125" y="135" width="22" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="160" y="135" width="25" height="12" rx="2" fill="#0a1f44"/>
                        <rect x="80" y="165" width="34" height="15" rx="2" fill="#0a1f44"/>
                        <rect x="125" y="157" width="22" height="23" rx="2" fill="#0a1f44"/>
                        <rect x="157" y="157" width="28" height="23" rx="2" fill="#04ccff"/>
                    </svg>
                </div>

                <div class="qris-apps">
                    <span>• BCA Mobile</span>
                    <span>• Livin' Mandiri</span>
                    <span>• BRImo</span>
                    <span>• BNI Mobile</span>
                    <span>• GoPay</span>
                    <span>• OVO</span>
                    <span>• DANA</span>
                    <span>• ShopeePay</span>
                </div>
            </div>

            <!-- Rekening Transfer Bank -->
            <h3>Transfer Langsung Bank & E-Wallet</h3>
            <p class="muted" style="margin-bottom: 1rem;">Bisa transfer melalui ATM, Internet Banking, atau m-Banking.</p>

            <div class="bank-list">
                <div class="bank-item">
                    <div class="bank-info">
                        <span class="bank-tag bca">BCA</span>
                        <div>
                            <div class="bank-num" id="rek-bca">8735 0921 44</div>
                            <div class="bank-owner">a.n. Komunitas Halowan.id</div>
                        </div>
                    </div>
                    <button type="button" class="copy-btn" onclick="copyRek('rek-bca', this)">Salin Rekening</button>
                </div>

                <div class="bank-item">
                    <div class="bank-info">
                        <span class="bank-tag mandiri">MANDIRI</span>
                        <div>
                            <div class="bank-num" id="rek-mandiri">152 00 8923 1120</div>
                            <div class="bank-owner">a.n. Komunitas Halowan.id</div>
                        </div>
                    </div>
                    <button type="button" class="copy-btn" onclick="copyRek('rek-mandiri', this)">Salin Rekening</button>
                </div>

                <div class="bank-item">
                    <div class="bank-info">
                        <span class="bank-tag bsi">BSI</span>
                        <div>
                            <div class="bank-num" id="rek-bsi">7123 4567 89</div>
                            <div class="bank-owner">a.n. Komunitas Halowan.id</div>
                        </div>
                    </div>
                    <button type="button" class="copy-btn" onclick="copyRek('rek-bsi', this)">Salin Rekening</button>
                </div>

                <div class="bank-item">
                    <div class="bank-info">
                        <span class="bank-tag ewallet">E-WALLET</span>
                        <div>
                            <div class="bank-num" id="rek-ewallet">0812 3456 7890</div>
                            <div class="bank-owner">GoPay / OVO / DANA (Halowan.id)</div>
                        </div>
                    </div>
                    <button type="button" class="copy-btn" onclick="copyRek('rek-ewallet', this)">Salin Nomor</button>
                </div>
            </div>

            <!-- Transparansi Alokasi -->
            <h3>Transparansi Penyaluran Donasi</h3>
            <p class="muted">Setiap rupiah yang masuk dikelola secara terbuka dan dilaporkan secara berkala.</p>

            <div class="impact-grid">
                <div class="impact-item">
                    <b>45%</b>
                    <span>Event & Workshop Gratis untuk Anggota</span>
                </div>
                <div class="impact-item">
                    <b>35%</b>
                    <span>Server, Domain & Pemeliharaan Platform</span>
                </div>
                <div class="impact-item">
                    <b>20%</b>
                    <span>Operasional & Apresiasi Relawan/Speaker</span>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Konfirmasi Donasi & Info WhatsApp -->
        <div>
            <div class="confirm-card">
                <h3 style="margin-bottom: .3rem;">Konfirmasi Donasi</h3>
                <p class="muted" style="font-size: .9rem; margin-bottom: 1.4rem;">Setelah transfer atau scan QRIS, konfirmasikan donasi Anda agar dapat kami catat dalam rekapitulasi supporter komunitas.</p>

                <form class="form" method="post" action="{{ route('donation.confirm') }}">
                    @csrf

                    <div class="field">
                        <label for="nama">Nama Donatur / Supporter</label>
                        <input type="text" id="nama" name="nama" placeholder="Contoh: Budi Santoso (Boleh Hamba Allah)" value="{{ old('nama', auth()->user()?->name) }}">
                    </div>

                    <div class="field">
                        <label for="email">Alamat Email (Opsional)</label>
                        <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email', auth()->user()?->email) }}">
                        <span class="hint">Untuk pengiriman ucapan terima kasih & rekap kegiatan.</span>
                    </div>

                    <div class="field">
                        <label for="nominal">Nominal Donasi (Rp) *</label>
                        <input type="text" id="nominalInput" name="nominal" required placeholder="50.000" value="{{ old('nominal', '50.000') }}">
                    </div>

                    <div class="field">
                        <label for="metode">Metode Pembayaran *</label>
                        <select id="metode" name="metode" required>
                            <option value="QRIS" {{ old('metode') === 'QRIS' ? 'selected' : '' }}>QRIS (GPN / All e-Wallet)</option>
                            <option value="Bank BCA" {{ old('metode') === 'Bank BCA' ? 'selected' : '' }}>Bank BCA</option>
                            <option value="Bank Mandiri" {{ old('metode') === 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                            <option value="Bank BSI" {{ old('metode') === 'Bank BSI' ? 'selected' : '' }}>Bank BSI</option>
                            <option value="GoPay/OVO/Dana" {{ old('metode') === 'GoPay/OVO/Dana' ? 'selected' : '' }}>E-Wallet (GoPay / OVO / Dana)</option>
                            <option value="Lainnya" {{ old('metode') === 'Lainnya' ? 'selected' : '' }}>Metode Lainnya</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="pesan">Pesan & Doa untuk Halowan.id (Opsional)</label>
                        <textarea id="pesan" name="pesan" rows="3" placeholder="Tuliskan harapan atau saran untuk komunitas...">{{ old('pesan') }}</textarea>
                    </div>

                    <button class="btn btn-navy btn-block" type="submit" style="margin-top: .5rem; padding: .95rem;">
                        Kirim Konfirmasi Donasi
                    </button>
                </form>

                <div style="text-align: center; margin: 1.4rem 0 1rem; position: relative;">
                    <hr style="border: none; border-top: 1px solid var(--line);">
                    <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: #ffffff; padding: 0 .8rem; font-size: .8rem; color: var(--muted);">atau konfirmasi instan</span>
                </div>

                <a class="btn btn-wa btn-block" href="https://wa.me/6281234567890?text=Halo%20Admin%20Halowan.id,%20saya%20sudah%20melakukan%20donasi%20untuk%20komunitas.%20Berikut%20bukti%20transfernya:" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="margin-right: .3rem;"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm.01 1.67c4.54 0 8.24 3.7 8.24 8.24 0 2.2-.86 4.28-2.42 5.84-1.56 1.56-3.64 2.41-5.83 2.41-1.46 0-2.89-.39-4.14-1.13l-.3-.18-3.08.81.82-3-.2-.31a8.16 8.16 0 01-1.26-4.44c0-4.54 3.7-8.24 8.17-8.24zm4.5 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.65.81-.8 1-.15.15-.3.17-.55.04-.25-.13-1.07-.39-2.03-1.25-.75-.67-1.26-1.5-1.41-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.3.38-.45.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.06-.13-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.45.06-.68.32-.23.25-.89.87-.89 2.12s.91 2.46 1.04 2.63c.13.17 1.8 2.75 4.36 3.86.61.26 1.09.42 1.46.54.61.2 1.17.17 1.61.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.17-.48-.3z"/></svg>
                    Konfirmasi via WhatsApp
                </a>
            </div>

            <div style="margin-top: 1.8rem;">
                <h4>Pertanyaan Seputar Donasi</h4>
                <div class="plain-list" style="margin-top: .8rem; font-size: .92rem;">
                    <div style="margin-bottom: .9rem;">
                        <b>Apakah donasi ini wajib?</b>
                        <p class="muted" style="margin: .2rem 0 0;">Tidak. Seluruh konten dan event Halowan.id tetap terbuka untuk umum. Donasi bersifat sukarela.</p>
                    </div>
                    <div style="margin-bottom: .9rem;">
                        <b>Apakah bisa berdonasi tanpa nama (anonim)?</b>
                        <p class="muted" style="margin: .2rem 0 0;">Tentu saja. Anda bisa mengisi nama dengan "Hamba Allah" atau "Anonim".</p>
                    </div>
                    <div>
                        <b>Butuh invoice atau bukti resmi donasi?</b>
                        <p class="muted" style="margin: .2rem 0 0;">Hubungi kami via WhatsApp jika Anda membutuhkan tanda terima resmi untuk perusahaan/organisasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function selectTier(amount, el) {
    document.querySelectorAll('.tier-card').forEach(c => c.classList.remove('is-selected'));
    if (el) el.classList.add('is-selected');
    const formatted = new Intl.NumberFormat('id-ID').format(amount);
    const input = document.getElementById('nominalInput');
    if (input) input.value = formatted;
}

function copyRek(elemId, btn) {
    const el = document.getElementById(elemId);
    if (!el) return;
    const text = el.innerText.replace(/\s+/g, '');
    navigator.clipboard.writeText(text).then(() => {
        const originalText = btn.innerText;
        btn.innerText = '✓ Tersalin!';
        btn.style.background = '#e4f8ef';
        btn.style.borderColor = '#9bdcbf';
        btn.style.color = '#0a6e49';
        setTimeout(() => {
            btn.innerText = originalText;
            btn.style.background = '';
            btn.style.borderColor = '';
            btn.style.color = '';
        }, 2000);
    }).catch(() => {
        alert('Nomor rekening: ' + text);
    });
}
</script>
@endsection
