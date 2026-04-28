<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Detail Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <a href="/user/pesanan" class="btn btn-outline-brown mb-4"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    
    <div class="row g-4">
        <div class="col-lg-8">
            <div style="background:white;border-radius:16px;padding:25px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                <h5 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>Detail Pesanan #<?= $order['id'] ?></h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $d): ?>
                                <tr>
                                    <td class="fw-600"><?= $d['nama_produk'] ?></td>
                                    <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                    <td><?= $d['jumlah'] ?></td>
                                    <td class="fw-bold">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="fw-bold" style="color:var(--accent);font-size:1.2rem;">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div style="background:white;border-radius:16px;padding:25px;box-shadow:0 2px 10px rgba(62,39,35,0.06);">
                <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Info Pesanan</h6>
                <?php
                    $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'dikirim' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                    $color = $statusColors[$order['status']] ?? 'secondary';
                ?>
                <p><strong>Status:</strong> <span class="badge bg-<?= $color ?>"><?= ucfirst($order['status']) ?></span></p>
                <p><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                <p><strong>Alamat:</strong> <?= $order['alamat_pengiriman'] ?></p>
                <p><strong>Catatan:</strong> <?= $order['catatan'] ?: '-' ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>