<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Tambah Produk<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Tambah Produk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-card">
    <h6 class="fw-bold mb-4"><i class="fas fa-plus-circle me-2"></i>Form Tambah Produk</h6>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger" style="border-radius: 12px;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p class="mb-0"><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/admin/produk/simpan" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-600">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control form-control-custom" value="<?= old('nama_produk') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-600">Kategori</label>
                <select name="kategori_id" class="form-select form-control-custom">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id'] ?>"><?= $kat['nama_kategori'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Harga</label>
                <input type="number" name="harga" class="form-control form-control-custom" value="<?= old('harga') ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Stok</label>
                <input type="number" name="stok" class="form-control form-control-custom" value="<?= old('stok') ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-600">Gambar</label>
                <input type="file" name="gambar" class="form-control form-control-custom" accept="image/*">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-600">Deskripsi</label>
            <textarea name="deskripsi" class="form-control form-control-custom" rows="4"><?= old('deskripsi') ?></textarea>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-accent"><i class="fas fa-save me-2"></i>Simpan</button>
            <a href="/admin/produk" class="btn btn-brown"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>