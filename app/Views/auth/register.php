<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Register<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .auth-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        padding: 40px 0;
    }
    .auth-card {
        background: var(--white);
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(62, 39, 35, 0.1);
        overflow: hidden;
    }
    .auth-side {
        background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }
    .auth-side i {
        font-size: 80px;
        color: var(--accent);
        margin-bottom: 20px;
    }
    .auth-form {
        padding: 40px;
    }
    .form-control-custom {
        border: 2px solid var(--brown-lighter);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }
    .form-control-custom:focus {
        border-color: var(--brown);
        box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-card">
                    <div class="row g-0">
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="auth-side h-100">
                                <i class="fas fa-user-plus"></i>
                                <h3 class="fw-bold mb-3">Bergabunglah!</h3>
                                <p style="opacity: 0.9;">Daftar akun untuk dapat memesan roti favorit Anda dari Toko Roti Hadi</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="auth-form">
                                <h3 class="fw-bold mb-1" style="color: var(--brown-dark);">Registrasi</h3>
                                <p class="text-muted mb-4">Buat akun baru</p>

                                <?php if (session()->getFlashdata('errors')): ?>
                                    <div class="alert alert-danger alert-custom">
                                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                            <p class="mb-0"><i class="fas fa-exclamation-circle me-1"></i><?= $error ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="/register" method="POST">
                                    <?= csrf_field() ?>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-600">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control form-control-custom" value="<?= old('nama') ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-600">Email</label>
                                            <input type="email" name="email" class="form-control form-control-custom" value="<?= old('email') ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-600">Password</label>
                                            <input type="password" name="password" class="form-control form-control-custom" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-600">Konfirmasi Password</label>
                                            <input type="password" name="konfirmasi_password" class="form-control form-control-custom" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-600">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control form-control-custom" value="<?= old('no_hp') ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-600">Alamat</label>
                                        <textarea name="alamat" class="form-control form-control-custom" rows="2"><?= old('alamat') ?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-brown w-100 py-3">
                                        <i class="fas fa-user-plus me-2"></i>Daftar
                                    </button>
                                </form>

                                <p class="text-center mt-4 mb-0">
                                    Sudah punya akun? <a href="/login" style="color: var(--accent); font-weight: 600;">Login Disini</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>