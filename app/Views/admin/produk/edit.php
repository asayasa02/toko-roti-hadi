<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Edit Produk<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Edit Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-card">
    <h6 class="fw-bold mb-4"><i class="fas fa-edit me-2"></i>Edit Produk</h6>

    <form action="/admin/produk/update/<?= $produk['id'] ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-600">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control form-control-custom" value="<?= $produk['nama_produk'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-600">Kategori</label>
                <select name="kategori_id" class="form-select form-control-custom">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>" <?= $produk['kategori_id'] == $kat['id'] ? 'selected' : '' ?>><?= $kat['nama_kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Harga</label>
                <input type="number" name="harga" class="form-control form-control-custom" value="<?= $produk['harga'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Stok</label>
                <input type="number" name="stok" class="form-control form-control-custom" value="<?= $produk['stok'] ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Gambar (kosongkan jika tidak diubah)</label>
                <input type="file" name="gambar" class="form-control form-control-custom" accept="image/*">
                <?php if ($produk['gambar'] && $produk['gambar'] !== 'default.jpg'): ?>
                    <small class="text-muted">Current: <?= $produk['gambar'] ?></small>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-600">Deskripsi</label>
            <textarea name="deskripsi" class="form-control form-control-custom" rows="4"><?= $produk['deskripsi'] ?></textarea>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-2"></i>Update</button>
            <a href="/admin/produk" class="btn btn-brown"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>