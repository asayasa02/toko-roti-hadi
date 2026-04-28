<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Admin Toko Roti Hadi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brown-dark: #3E2723;
            --brown: #5D4037;
            --brown-medium: #795548;
            --brown-light: #A1887F;
            --brown-lighter: #D7CCC8;
            --brown-bg: #EFEBE9;
            --cream: #FFF8E1;
            --white: #FFFFFF;
            --accent: #FF8F00;
            --accent-light: #FFB300;
            --sidebar-width: 260px;
        }

        * { font-family: 'Poppins', sans-serif; }
        body { background-color: var(--brown-bg); }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--brown-dark) 0%, var(--brown) 100%);
            padding: 20px 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-brand {
            color: var(--cream);
            font-weight: 800;
            font-size: 1.3rem;
            padding: 10px 25px 30px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-brand i { color: var(--accent); }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--brown-lighter);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-left-color: var(--accent);
        }

        .sidebar-menu li a i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin: 15px 25px;
        }

        .sidebar-label {
            color: var(--brown-light);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 10px 25px 5px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            background: var(--white);
            border-radius: 16px;
            padding: 15px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(62,39,35,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card {
            background: var(--white);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(62,39,35,0.06);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(62,39,35,0.12);
        }

        .stat-card .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
        }

        .content-card {
            background: var(--white);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(62,39,35,0.06);
        }

        .table th {
            color: var(--brown);
            font-weight: 600;
            border-bottom: 2px solid var(--brown-lighter);
        }

        .btn-brown {
            background: linear-gradient(135deg, var(--brown) 0%, var(--brown-medium) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-brown:hover {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
            color: var(--white);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-accent:hover {
            background: linear-gradient(135deg, #E65100 0%, var(--accent) 100%);
            color: var(--white);
        }

        .form-control-custom {
            border: 2px solid var(--brown-lighter);
            border-radius: 10px;
            padding: 10px 14px;
            transition: all 0.3s;
        }

        .form-control-custom:focus {
            border-color: var(--brown);
            box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.1);
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-bread-slice me-2"></i>Toko Roti Hadi
        </div>
        <div class="sidebar-label">Menu Utama</div>
        <ul class="sidebar-menu">
            <li><a href="/admin/dashboard" class="<?= str_contains(uri_string(), 'admin/dashboard') ? 'active' : '' ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/admin/produk" class="<?= str_contains(uri_string(), 'admin/produk') ? 'active' : '' ?>"><i class="fas fa-bread-slice"></i> Produk</a></li>
            <li><a href="/admin/kategori" class="<?= str_contains(uri_string(), 'admin/kategori') ? 'active' : '' ?>"><i class="fas fa-tags"></i> Kategori</a></li>
            <li><a href="/admin/pesanan" class="<?= str_contains(uri_string(), 'admin/pesanan') ? 'active' : '' ?>"><i class="fas fa-shopping-bag"></i> Pesanan</a></li>
        </ul>
        <div class="sidebar-divider"></div>
        <div class="sidebar-label">Lainnya</div>
        <ul class="sidebar-menu">
            <li><a href="/" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat Website</a></li>
            <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0 fw-bold" style="color: var(--brown-dark);"><?= $this->renderSection('page-title') ?></h5>
            <div class="d-flex align-items-center gap-3">
                <span style="color: var(--brown-light);"><i class="fas fa-user-shield me-2"></i><?= session()->get('nama') ?></span>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; border: none;">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 12px; border: none;">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>