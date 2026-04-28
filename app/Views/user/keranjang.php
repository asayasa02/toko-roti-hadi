<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Keranjang<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h3 class="fw-bold mb-4" style="color: var(--brown-dark);"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h3>

    <?php if (!empty($keranjang)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <?php foreach ($keranjang as $item): ?>
                    <div style="background:white;border-radius:16px;padding:20px;margin-bottom:15px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                        <div class="d-flex align-items-center gap-3">
                            <?php
                                $gPath = 'uploads/produk/' . $item['gambar'];
                                $gUrl = file_exists($gPath) ? base_url($gPath) : 'https://via.placeholder.com/80x80/795548/FFFFFF?text=Roti';
                            ?>
                            <img src="<?= $gUrl ?>" style="width:80px;height:80px;object-fit:cover;border-radius:12px;">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1"><?= $item['nama_produk'] ?></h6>
                                <p class="mb-0" style="color:var(--accent);font-weight:700;">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            </div>
                            <form action="/user/keranjang/update" method="POST" class="d-flex align-items-center gap-2">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="number" name="jumlah" value="<?= $item['jumlah'] ?>" min="1" max="<?= $item['stok'] ?>" class="form-control form-control-custom" style="width:80px;">
                                <button type="submit" class="btn btn-sm btn-brown"><i class="fas fa-sync"></i></button>
                            </form>
                            <div>
                                <strong style="color:var(--brown-dark);">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.') ?></strong>
                            </div>
                            <a href="/user/keranjang/hapus/<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus item ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div style="background:white;border-radius:16px;padding:25px;box-shadow:0 2px 10px rgba(62,39,35,0.06);position:sticky;top:100px;">
                    <h6 class="fw-bold mb-3"><i class="fas fa-receipt me-2"></i>Ringkasan</h6>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Item</span>
                        <span class="fw-bold"><?= count($keranjang) ?> produk</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold" style="font-size:1.1rem;">Total Harga</span>
                        <span class="fw-bold" style="color:var(--accent);font-size:1.2rem;">Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                    <a href="/user/checkout" class="btn btn-accent w-100">
                        <i class="fas fa-credit-card me-2"></i>Checkout
                    </a>
                    <a href="/katalog" class="btn btn-outline-brown w-100 mt-2">
                        <i class="fas fa-plus me-2"></i>Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center py-5" style="background:white;border-radius:20px;">
            <i class="fas fa-shopping-cart" style="font-size:80px;color:var(--brown-lighter);"></i>
            <h4 class="mt-3" style="color:var(--brown-light);">Keranjang Anda Kosong</h4>
            <p class="text-muted">Yuk mulai belanja roti favorit Anda!</p>
            <a href="/katalog" class="btn btn-accent"><i class="fas fa-store me-2"></i>Lihat Katalog</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>