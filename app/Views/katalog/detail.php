<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?><?= esc($produk['nama_produk']) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" style="color: var(--brown);">Beranda</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('katalog') ?>" style="color: var(--brown);">Katalog</a></li>
            <li class="breadcrumb-item active"><?= esc($produk['nama_produk']) ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <div class="col-lg-6">
            <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(62,39,35,0.1);">
                <img src="<?= get_gambar_url($produk['gambar']) ?>" 
                     class="w-100" 
                     style="height: 400px; object-fit: cover;" 
                     alt="<?= esc($produk['nama_produk']) ?>"
                     onerror="this.src='https://placehold.co/600x400/795548/FFFFFF?text=Roti+Hadi'">
            </div>
        </div>
        <div class="col-lg-6">
            <span class="badge" style="background: var(--brown-lighter); color: var(--brown-dark); font-size: 0.9rem; padding: 8px 16px; border-radius: 20px;">
                <i class="fas fa-tag me-1"></i><?= esc($produk['nama_kategori'] ?? 'Umum') ?>
            </span>
            <h2 class="fw-bold mt-3" style="color: var(--brown-dark);"><?= esc($produk['nama_produk']) ?></h2>
            <h3 style="color: var(--accent); font-weight: 700;" class="my-3">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></h3>
            
            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="badge <?= $produk['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>" style="font-size: 0.9rem; padding: 8px 16px; border-radius: 20px;">
                    <?= $produk['stok'] > 0 ? 'Stok: ' . $produk['stok'] : 'Stok Habis' ?>
                </span>
            </div>

            <div style="background: var(--brown-bg); border-radius: 16px; padding: 20px;" class="mb-4">
                <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2"></i>Deskripsi</h6>
                <p class="mb-0" style="color: var(--brown-medium); line-height: 1.8;">
                    <?= esc($produk['deskripsi'] ?: 'Tidak ada deskripsi.') ?>
                </p>
            </div>

            <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user'): ?>
                <?php if ($produk['stok'] > 0): ?>
                    <form action="<?= base_url('user/keranjang/tambah') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <label class="fw-600">Jumlah:</label>
                            <input type="number" name="jumlah" value="1" min="1" max="<?= $produk['stok'] ?>" 
                                   class="form-control" style="width:100px;border:2px solid var(--brown-lighter);border-radius:12px;">
                        </div>
                        <button type="submit" class="btn btn-accent btn-lg">
                            <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                        </button>
                    </form>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg" disabled>
                        <i class="fas fa-times me-2"></i>Stok Habis
                    </button>
                <?php endif; ?>
            <?php elseif (!session()->get('isLoggedIn')): ?>
                <div class="alert" style="background: var(--cream); border-left: 4px solid var(--accent); border-radius: 12px;">
                    <i class="fas fa-info-circle me-2" style="color: var(--accent);"></i>
                    <a href="<?= base_url('login') ?>" style="color: var(--accent); font-weight: 600;">Login</a> untuk dapat memesan produk ini.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Produk Lain -->
    <?php if (!empty($produk_lain)): ?>
        <div class="mt-5 pt-4">
            <h4 class="section-title">Produk Serupa</h4>
            <div class="row g-4 mt-3">
                <?php foreach ($produk_lain as $item): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-product">
                            <img src="<?= get_gambar_url($item['gambar']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= esc($item['nama_produk']) ?>"
                                 onerror="this.src='https://placehold.co/400x250/795548/FFFFFF?text=Roti'">
                            <div class="card-body">
                                <h6 class="product-name"><?= esc($item['nama_produk']) ?></h6>
                                <p class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                <a href="<?= base_url('katalog/detail/' . $item['id']) ?>" class="btn btn-outline-brown btn-sm w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>