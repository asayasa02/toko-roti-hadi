<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #5D4037, #795548);">
                    <i class="fas fa-bread-slice"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">Total Produk</p>
                    <h3 class="mb-0 fw-bold" style="color: var(--brown-dark);"><?= $total_produk ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #FF8F00, #FFB300);">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">Total Pesanan</p>
                    <h3 class="mb-0 fw-bold" style="color: var(--brown-dark);"><?= $total_pesanan ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #43A047, #66BB6A);">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">Total User</p>
                    <h3 class="mb-0 fw-bold" style="color: var(--brown-dark);"><?= $total_user ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #E53935, #EF5350);">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="mb-0 text-muted" style="font-size: 0.85rem;">Pending</p>
                    <h3 class="mb-0 fw-bold" style="color: var(--brown-dark);"><?= $pesanan_pending ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card">
            <h6 class="fw-bold mb-3" style="color: var(--brown-dark);"><i class="fas fa-history me-2"></i>Pesanan Terbaru</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pesanan_terbaru)): ?>
                            <?php foreach ($pesanan_terbaru as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php
                                            $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'dikirim' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                                            $color = $statusColors[$p['status']] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $color ?>"><?= ucfirst($p['status']) ?></span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada pesanan</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="content-card">
            <h6 class="fw-bold mb-3" style="color: var(--brown-dark);"><i class="fas fa-wallet me-2"></i>Total Pendapatan</h6>
            <h2 class="fw-bold" style="color: var(--accent);">Rp <?= number_format($pendapatan, 0, ',', '.') ?></h2>
            <p class="text-muted mb-0">Dari pesanan yang sudah selesai</p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>