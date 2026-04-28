<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Detail Pesanan<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Detail Pesanan #<?= $order['id'] ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="content-card">
            <h6 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>Item Pesanan</h6>
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
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php
                                            $gPath = 'uploads/produk/' . $d['gambar'];
                                            $gUrl = file_exists($gPath) ? base_url($gPath) : 'https://via.placeholder.com/50x50/795548/FFFFFF?text=R';
                                        ?>
                                        <img src="<?= $gUrl ?>" style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                                        <span class="fw-600"><?= $d['nama_produk'] ?></span>
                                    </div>
                                </td>
                                <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                <td><?= $d['jumlah'] ?></td>
                                <td class="fw-bold">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total:</td>
                            <td class="fw-bold" style="color: var(--accent); font-size: 1.2rem;">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="content-card mb-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-user me-2"></i>Info Pelanggan</h6>
            <p><strong>Nama:</strong> <?= $order['nama'] ?></p>
            <p><strong>Email:</strong> <?= $order['email'] ?></p>
            <p><strong>HP:</strong> <?= $order['no_hp'] ?? '-' ?></p>
        </div>
        <div class="content-card mb-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-info-circle me-2"></i>Info Pesanan</h6>
            <p><strong>Alamat:</strong> <?= $order['alamat_pengiriman'] ?></p>
            <p><strong>Catatan:</strong> <?= $order['catatan'] ?: '-' ?></p>
            <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
            <?php
                $statusColors = ['pending' => 'warning', 'diproses' => 'info', 'dikirim' => 'primary', 'selesai' => 'success', 'dibatalkan' => 'danger'];
                $color = $statusColors[$order['status']] ?? 'secondary';
            ?>
            <p><strong>Status:</strong> <span class="badge bg-<?= $color ?>"><?= ucfirst($order['status']) ?></span></p>
        </div>
        <a href="/admin/pesanan" class="btn btn-brown w-100"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
    </div>
</div>
<?= $this->endSection() ?>