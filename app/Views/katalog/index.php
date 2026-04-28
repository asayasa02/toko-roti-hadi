<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Katalog<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .katalog-header {
        background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
        padding: 60px 0;
        text-align: center;
        color: white;
    }
    .filter-card {
        background: var(--white);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.08);
        margin-top: -30px;
        position: relative;
        z-index: 10;
    }
    .btn-filter {
        border: 2px solid var(--brown-lighter);
        color: var(--brown);
        border-radius: 25px;
        padding: 6px 18px;
        font-size: 0.9rem;
        transition: all 0.3s;
        background: transparent;
        font-weight: 500;
    }
    .btn-filter:hover, .btn-filter.active {
        background: var(--brown);
        color: white;
        border-color: var(--brown);
    }
    .stock-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="katalog-header">
    <div class="container">
        <h1 class="fw-bold"><i class="fas fa-store me-3"></i>Katalog Produk</h1>
        <p class="mb-0" style="opacity: 0.9;">Temukan roti dan kue favorit Anda</p>
    </div>
</div>

<div class="container">
    <!-- Filter -->
    <div class="filter-card">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-3 mb-lg-0">
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url('katalog') ?>" class="btn btn-filter <?= !$selectedKategori ? 'active' : '' ?>">Semua</a>
                    <?php foreach ($kategori as $kat): ?>
                        <a href="<?= base_url('katalog?kategori=' . $kat['id']) ?>" class="btn btn-filter <?= $selectedKategori == $kat['id'] ? 'active' : '' ?>">
                            <?= esc($kat['nama_kategori']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <form action="<?= base_url('katalog') ?>" method="GET" class="d-flex gap-2">
                    <?php if ($selectedKategori): ?>
                        <input type="hidden" name="kategori" value="<?= $selectedKategori ?>">
                    <?php endif; ?>
                    <input type="text" name="search" class="form-control" style="border:2px solid var(--brown-lighter);border-radius:12px;" placeholder="Cari produk..." value="<?= esc($search) ?>">
                    <button type="submit" class="btn btn-brown"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="row g-4 mt-3">
        <?php if (!empty($produk)): ?>
            <?php foreach ($produk as $item): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="card card-product position-relative">
                        <?php if ($item['stok'] > 0): ?>
                            <span class="stock-badge bg-success text-white"><i class="fas fa-check me-1"></i>Tersedia</span>
                        <?php else: ?>
                            <span class="stock-badge bg-danger text-white">Habis</span>
                        <?php endif; ?>
                        
                        <img src="<?= get_gambar_url($item['gambar']) ?>" 
                             class="card-img-top" 
                             alt="<?= esc($item['nama_produk']) ?>"
                             onerror="this.src='https://placehold.co/400x250/795548/FFFFFF?text=Roti'">
                        <div class="card-body">
                            <span class="product-category">
                                <i class="fas fa-tag me-1"></i><?= esc($item['nama_kategori'] ?? 'Umum') ?>
                            </span>
                            <h5 class="product-name mt-2"><?= esc($item['nama_produk']) ?></h5>
                            <p class="product-price mb-3">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                            
                            <div class="d-flex gap-2">
                                <a href="<?= base_url('katalog/detail/' . $item['id']) ?>" class="btn btn-outline-brown btn-sm flex-fill">
                                    <i class="fas fa-eye me-1"></i>Detail
                                </a>
                                <?php if (session()->get('isLoggedIn') && session()->get('role') === 'user' && $item['stok'] > 0): ?>
                                    <form action="<?= base_url('user/keranjang/tambah') ?>" method="POST" class="flex-fill">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="produk_id" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="btn btn-accent btn-sm w-100">
                                            <i class="fas fa-cart-plus me-1"></i>Beli
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search" style="font-size: 60px; color: var(--brown-lighter);"></i>
                    <h4 class="mt-3" style="color: var(--brown-light);">Produk tidak ditemukan</h4>
                    <a href="<?= base_url('katalog') ?>" class="btn btn-brown">Lihat Semua Produk</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>