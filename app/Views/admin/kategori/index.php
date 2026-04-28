<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Kelola Kategori<?= $this->endSection() ?>
<?= $this->section('page-title') ?>Kelola Kategori<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row g-4">
    <div class="col-lg-5">
        <div class="content-card">
            <h6 class="fw-bold mb-3"><i class="fas fa-plus-circle me-2"></i>Tambah Kategori</h6>
            <form action="/admin/kategori/simpan" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <input type="text" name="nama_kategori" class="form-control form-control-custom" placeholder="Nama kategori" required>
                </div>
                <button type="submit" class="btn btn-accent w-100"><i class="fas fa-save me-2"></i>Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="content-card">
            <h6 class="fw-bold mb-3"><i class="fas fa-tags me-2"></i>Daftar Kategori</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($kategori as $kat): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <form action="/admin/kategori/update/<?= $kat['id'] ?>" method="POST" class="d-flex gap-2">
                                        <?= csrf_field() ?>
                                        <input type="text" name="nama_kategori" class="form-control form-control-custom form-control-sm" value="<?= $kat['nama_kategori'] ?>">
                                        <button type="submit" class="btn btn-sm btn-brown"><i class="fas fa-check"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <a href="/admin/kategori/hapus/<?= $kat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>