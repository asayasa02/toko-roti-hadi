<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <div style="background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%); border-radius: 20px; padding: 40px; color: white;">
                <h2 class="fw-bold mb-1">Halo, <?= session()->get('nama') ?>! 👋</h2>
                <p style="opacity: 0.9;" class="mb-0">Selamat datang di dashboard Toko Roti Hadi</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(62,39,35,0.06);">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:55px;height:55px;background:linear-gradient(135deg,var(--accent),var(--accent-light));border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.3rem;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">Total Pesanan</p>
                        <h3 class="mb-0 fw-bold"><?= $total_pesanan ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(62,39,35,0.06);">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:55px;height:55px;background:linear-gradient(135deg,#43A047,#66BB6A);border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.3rem;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">Pesanan Aktif</p>
                        <h3 class="mb-0 fw-bold"><?= $pesanan_aktif ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(62,39,35,0.06);">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:55px;height:55px;background:linear-gradient(135deg,var(--brown),var(--brown-medium));border-radius:14px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.3rem;">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted" style="font-size:0.85rem;">Keranjang</p>
                        <h3 class="mb-0 fw-bold"><?= $item_keranjang ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(62,39,35,0.06);">
                <h6 class="fw-bold mb-3"><i class="fas fa-history me-2"></i>Pesanan Terbaru</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pesanan_terbaru)): ?>
                                <?php foreach ($pesanan_terbaru as $p): ?>
                                    <tr>
                                        <td><?= $p['id'] ?></td>
                                        <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <?php
                                                $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'dikirim' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                                                $color = $statusColors[$p['status']] ?? 'secondary';
                                            ?>
                                            <span class="badge bg-<?= $color ?>"><?= ucfirst($p['status']) ?></span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                        <td><a href="/user/pesanan/detail/<?= $p['id'] ?>" class="btn btn-sm btn-outline-brown">Detail</a></td>
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
            <div style="background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(62,39,35,0.06);">
                <h6 class="fw-bold mb-3"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h6>
                <div class="d-grid gap-2">
                    <a href="/katalog" class="btn btn-accent"><i class="fas fa-store me-2"></i>Lihat Katalog</a>
                    <a href="/user/keranjang" class="btn btn-brown"><i class="fas fa-shopping-cart me-2"></i>Keranjang Saya</a>
                    <a href="/user/pesanan" class="btn btn-outline-brown"><i class="fas fa-list me-2"></i>Semua Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>