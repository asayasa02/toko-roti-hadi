<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Kelola Pesanan<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Kelola Pesanan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-card">
    <h6 class="fw-bold mb-4"><i class="fas fa-shopping-bag me-2"></i>Daftar Pesanan</h6>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pesanan)): ?>
                    <?php foreach ($pesanan as $p): ?>
                        <tr>
                            <td>#<?= $p['id'] ?></td>
                            <td>
                                <strong><?= $p['nama'] ?></strong><br>
                                <small class="text-muted"><?= $p['email'] ?></small>
                            </td>
                            <td class="fw-bold">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <form action="/admin/pesanan/updateStatus/<?= $p['id'] ?>" method="POST" class="d-flex gap-2">
                                    <?= csrf_field() ?>
                                    <select name="status" class="form-select form-select-sm form-control-custom" style="width: 140px;">
                                        <?php foreach (['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'] as $s): ?>
                                            <option value="<?= $s ?>" <?= $p['status'] == $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-brown"><i class="fas fa-check"></i></button>
                                </form>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></td>
                            <td>
                                <a href="/admin/pesanan/detail/<?= $p['id'] ?>" class="btn btn-sm btn-accent"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-muted">Belum ada pesanan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>