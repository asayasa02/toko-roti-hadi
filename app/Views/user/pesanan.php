<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Pesanan Saya<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h3 class="fw-bold mb-4" style="color: var(--brown-dark);"><i class="fas fa-shopping-bag me-2"></i>Pesanan Saya</h3>

    <?php if (!empty($pesanan)): ?>
        <?php foreach ($pesanan as $p): ?>
            <div style="background:white;border-radius:16px;padding:20px;margin-bottom:15px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h6 class="fw-bold mb-1">Pesanan #<?= $p['id'] ?></h6>
                        <small class="text-muted"><i class="fas fa-calendar me-1"></i><?= date('d M Y, H:i', strtotime($p['created_at'])) ?></small>
                    </div>
                    <div class="text-end">
                        <?php
                            $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'dikirim' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                            $color = $statusColors[$p['status']] ?? 'secondary';
                        ?>
                        <span class="badge bg-<?= $color ?>" style="font-size:0.85rem;padding:6px 14px;border-radius:20px;"><?= ucfirst($p['status']) ?></span>
                        <h5 class="fw-bold mt-2 mb-0" style="color:var(--accent);">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></h5>
                    </div>
                    <a href="/user/pesanan/detail/<?= $p['id'] ?>" class="btn btn-outline-brown btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5" style="background:white;border-radius:20px;">
            <i class="fas fa-shopping-bag" style="font-size:80px;color:var(--brown-lighter);"></i>
            <h4 class="mt-3" style="color:var(--brown-light);">Belum Ada Pesanan</h4>
            <a href="/katalog" class="btn btn-accent mt-2"><i class="fas fa-store me-2"></i>Mulai Belanja</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>