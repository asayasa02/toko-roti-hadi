<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Beranda<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .hero-section {
        background: linear-gradient(135deg, rgba(62, 39, 35, 0.92) 0%, rgba(93, 64, 55, 0.88) 100%),
                    url('https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1920') center/cover;
        min-height: 92vh;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(transparent, var(--brown-bg));
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--white);
        line-height: 1.2;
    }

    .hero-title span { color: var(--accent); }

    .hero-subtitle {
        font-size: 1.2rem;
        color: var(--brown-lighter);
        margin: 20px 0 35px;
        line-height: 1.8;
    }

    .hero-btn {
        padding: 14px 35px;
        font-size: 1.1rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .hero-btn-primary {
        background: var(--accent);
        color: white;
    }

    .hero-btn-primary:hover {
        background: var(--accent-light);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 143, 0, 0.4);
    }

    .hero-btn-outline {
        border: 2px solid var(--brown-lighter);
        color: var(--brown-lighter);
    }

    .hero-btn-outline:hover {
        background: var(--white);
        color: var(--brown-dark);
        border-color: var(--white);
        transform: translateY(-3px);
    }

    .hero-stats {
        display: flex;
        gap: 40px;
        margin-top: 50px;
    }

    .hero-stat h3 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent);
        margin-bottom: 0;
    }

    .hero-stat p {
        color: var(--brown-lighter);
        font-size: 0.9rem;
    }

    .floating-bread {
        position: absolute;
        right: -50px;
        top: 50%;
        transform: translateY(-50%);
        width: 500px;
        height: 500px;
        background: rgba(255, 143, 0, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .floating-bread i {
        font-size: 200px;
        color: rgba(255, 143, 0, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .feature-card {
        background: var(--white);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(62, 39, 35, 0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(62, 39, 35, 0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--brown-lighter) 0%, var(--brown-light) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: var(--white);
    }

    .cta-section {
        background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
        border-radius: 24px;
        padding: 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 143, 0, 0.1);
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem; }
        .hero-stats { gap: 20px; }
        .floating-bread { display: none; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="text-uppercase fw-bold mb-3" style="color: var(--accent); letter-spacing: 3px; font-size: 0.9rem;">
                    <i class="fas fa-star me-2"></i>Premium Bakery Since 2020
                </p>
                <h1 class="hero-title">
                    Roti Segar <span>Berkualitas</span><br>Setiap Hari
                </h1>
                <p class="hero-subtitle">
                    Dibuat dengan cinta dan bahan-bahan terbaik. Nikmati kelezatan roti artisan kami
                    yang dipanggang sempurna setiap hari untuk keluarga Anda.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= base_url('katalog') ?>" class="hero-btn hero-btn-primary">
                        <i class="fas fa-shopping-bag me-2"></i>Lihat Katalog
                    </a>
                    <?php if (!session()->get('isLoggedIn')): ?>
                        <a href="<?= base_url('register') ?>" class="hero-btn hero-btn-outline">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    <?php endif; ?>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <h3>50+</h3>
                        <p>Varian Roti</p>
                    </div>
                    <div class="hero-stat">
                        <h3>1000+</h3>
                        <p>Pelanggan</p>
                    </div>
                    <div class="hero-stat">
                        <h3>4.9</h3>
                        <p>Rating ⭐</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="floating-bread">
                    <i class="fas fa-bread-slice"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Kenapa Pilih Kami?</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-leaf"></i></div>
                    <h5 class="fw-bold">Bahan Alami</h5>
                    <p class="text-muted">100% bahan alami tanpa pengawet berbahaya</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, var(--accent), var(--accent-light));">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h5 class="fw-bold">Fresh Baked</h5>
                    <p class="text-muted">Dipanggang segar setiap hari langsung dari oven</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-truck"></i></div>
                    <h5 class="fw-bold">Delivery Cepat</h5>
                    <p class="text-muted">Pengiriman cepat langsung ke depan pintu Anda</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, var(--accent), var(--accent-light));">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="fw-bold">Dibuat Dengan Cinta</h5>
                    <p class="text-muted">Setiap produk dibuat dengan penuh kasih sayang</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk Unggulan -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Produk Unggulan</h2>
        </div>
        <div class="row g-4">
            <?php if(!empty($produk_unggulan)): ?>
                <?php foreach ($produk_unggulan as $item): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card card-product">
                            <img src="<?= esc($item['gambar']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= esc($item['nama_produk']) ?>"
                                 onerror="this.src='https://placehold.co/400x250/795548/FFFFFF?text=Roti'">
                            <div class="card-body">
                                <span class="product-category">
                                    <i class="fas fa-tag me-1"></i><?= esc($item['nama_kategori'] ?? 'Umum') ?>
                                </span>
                                <h5 class="product-name mt-2"><?= esc($item['nama_produk']) ?></h5>
                                <p class="product-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                <a href="<?= base_url('katalog/detail/' . $item['id']) ?>" class="btn btn-brown btn-sm w-100">
                                    <i class="fas fa-eye me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="<?= base_url('katalog') ?>" class="btn btn-accent btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Lihat Semua Produk
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5">
    <div class="container">
        <div class="cta-section text-center">
            <h2 class="fw-bold mb-3" style="font-size: 2.2rem;">Siap Memesan Roti Favorit Anda?</h2>
            <p class="mb-4" style="font-size: 1.1rem; opacity: 0.9;">Daftar sekarang dan dapatkan pengalaman berbelanja roti terbaik!</p>
            <?php if (!session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('register') ?>" class="hero-btn hero-btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Daftar Gratis Sekarang
                </a>
            <?php else: ?>
                <a href="<?= base_url('katalog') ?>" class="hero-btn hero-btn-primary">
                    <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>