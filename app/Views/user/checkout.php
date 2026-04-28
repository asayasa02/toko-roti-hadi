<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Checkout<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h3 class="fw-bold mb-4" style="color: var(--brown-dark);"><i class="fas fa-credit-card me-2"></i>Checkout</h3>

    <form action="/user/checkout/proses" method="POST">
        <?= csrf_field() ?>
        <div class="row g-4">
            <div class="col-lg-7">
                <div style="background:white;border-radius:16px;padding:25px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                    <h6 class="fw-bold mb-3"><i class="fas fa-map-marker-alt me-2"></i>Informasi Pengiriman</h6>
                    <div class="mb-3">
                        <label class="form-label fw-600">Alamat Pengiriman</label>
                        <textarea name="alamat" class="form-control form-control-custom" rows="3" required placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600">Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control form-control-custom" rows="2" placeholder="Catatan khusus untuk pesanan"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div style="background:white;border-radius:16px;padding:25px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                    <h6 class="fw-bold mb-3"><i class="fas fa-receipt me-2"></i>Ringkasan Pesanan</h6>
                    <?php foreach ($keranjang as $item): ?>
                        <div class="d-flex justify-content-between align-items-center mb-2" style="padding:8px 0;border-bottom:1px solid var(--brown-bg);">
                            <div>
                                <span class="fw-600"><?= $item['nama_produk'] ?></span>
                                <small class="text-muted d-block">x<?= $item['jumlah'] ?></small>
                            </div>
                            <span class="fw-bold">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></span>
                        </div>
                    <?php endforeach; ?>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold" style="font-size:1.1rem;">Total</span>
                        <span class="fw-bold" style="color:var(--accent);font-size:1.3rem;">Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                    <button type="submit" class="btn btn-accent w-100 mt-3 py-3">
                        <i class="fas fa-check me-2"></i>Buat Pesanan
                    </button>
                    <a href="/user/keranjang" class="btn btn-outline-brown w-100 mt-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>