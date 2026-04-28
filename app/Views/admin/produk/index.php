<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Kelola Produk<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Kelola Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h6 class="fw-bold mb-0"><i class="fas fa-bread-slice me-2"></i>Daftar Produk</h6>
        <a href="/admin/produk/tambah" class="btn btn-accent">
            <i class="fas fa-plus me-2"></i>Tambah Produk
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($produk as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php
                                $gambarPath = 'uploads/produk/' . $item['gambar'];
                                $gambarUrl = file_exists($gambarPath) ? base_url($gambarPath) : 'https://via.placeholder.com/80x80/795548/FFFFFF?text=Roti';
                            ?>
                            <img src="<?= $gambarUrl ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                        </td>
                        <td class="fw-600"><?= $item['nama_produk'] ?></td>
                        <td><span class="badge" style="background: var(--brown-lighter); color: var(--brown-dark);"><?= $item['nama_kategori'] ?? '-' ?></span></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge bg-<?= $item['stok'] > 0 ? 'success' : 'danger' ?>"><?= $item['stok'] ?></span>
                        </td>
                        <td>
                            <a href="/admin/produk/edit/<?= $item['id'] ?>" class="btn btn-sm btn-brown"><i class="fas fa-edit"></i></a>
                            <a href="/admin/produk/hapus/<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>