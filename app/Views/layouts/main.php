<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Toko Roti Hadi</title>
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
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--brown-bg);
            color: var(--brown-dark);
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
            padding: 12px 0;
            box-shadow: 0 4px 20px rgba(62, 39, 35, 0.3);
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--cream) !important;
            letter-spacing: 1px;
        }

        .navbar-custom .navbar-brand i {
            color: var(--accent);
        }

        .navbar-custom .nav-link {
            color: var(--brown-lighter) !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 2px;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--white) !important;
            background: rgba(255, 255, 255, 0.15);
        }

        .navbar-custom .btn-login {
            background: var(--accent);
            color: var(--white) !important;
            border: none;
            padding: 8px 20px !important;
            border-radius: 25px;
            font-weight: 600;
        }

        .navbar-custom .btn-login:hover {
            background: var(--accent-light);
            transform: translateY(-2px);
        }

        .badge-cart {
            background: var(--accent);
            color: white;
            border-radius: 50%;
            padding: 2px 7px;
            font-size: 0.7rem;
            position: relative;
            top: -8px;
            left: -5px;
        }

        /* Cards */
        .card-product {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(62, 39, 35, 0.1);
            transition: all 0.3s ease;
            background: var(--white);
        }

        .card-product:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(62, 39, 35, 0.2);
        }

        .card-product .card-img-top {
            height: 220px;
            object-fit: cover;
        }

        .card-product .card-body {
            padding: 20px;
        }

        .card-product .product-name {
            font-weight: 600;
            color: var(--brown-dark);
            font-size: 1.1rem;
        }

        .card-product .product-price {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .card-product .product-category {
            color: var(--brown-light);
            font-size: 0.85rem;
        }

        /* Buttons */
        .btn-brown {
            background: linear-gradient(135deg, var(--brown) 0%, var(--brown-medium) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-brown:hover {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(62, 39, 35, 0.3);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            background: linear-gradient(135deg, #E65100 0%, var(--accent) 100%);
            color: var(--white);
            transform: translateY(-2px);
        }

        .btn-outline-brown {
            border: 2px solid var(--brown);
            color: var(--brown);
            border-radius: 10px;
            padding: 8px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }

        .btn-outline-brown:hover {
            background: var(--brown);
            color: var(--white);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown) 100%);
            color: var(--brown-lighter);
            padding: 50px 0 20px;
            margin-top: 60px;
        }

        .footer h5 {
            color: var(--cream);
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer a {
            color: var(--brown-lighter);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--accent);
        }

        /* Section Title */
        .section-title {
            font-weight: 800;
            color: var(--brown-dark);
            position: relative;
            display: inline-block;
            margin-bottom: 40px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }

        /* Alert */
        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-bread-slice me-2"></i>Toko Roti Hadi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: rgba(255,255,255,0.3);">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>" href="/"><i class="fas fa-home me-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(uri_string(), 'katalog') ? 'active' : '' ?>" href="/katalog"><i class="fas fa-store me-1"></i> Katalog</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/dashboard"><i class="fas fa-tachometer-alt me-1"></i> Dashboard Admin</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/keranjang">
                                    <i class="fas fa-shopping-cart me-1"></i> Keranjang
                                    <?php 
                                        $keranjangModel = new \App\Models\KeranjangModel();
                                        $count = $keranjangModel->getCartCount(session()->get('user_id'));
                                        if ($count > 0): 
                                    ?>
                                        <span class="badge-cart"><?= $count ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/dashboard"><i class="fas fa-user me-1"></i> Dashboard</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn-login" href="/login"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-3">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-custom alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-bread-slice me-2"></i>Toko Roti Hadi</h5>
                    <p>Menyajikan roti dan kue berkualitas terbaik dengan bahan-bahan pilihan. Kelezatan di setiap gigitan!</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/"><i class="fas fa-chevron-right me-2"></i>Beranda</a></li>
                        <li class="mb-2"><a href="/katalog"><i class="fas fa-chevron-right me-2"></i>Katalog</a></li>
                        <li class="mb-2"><a href="/login"><i class="fas fa-chevron-right me-2"></i>Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i>Jl. Roti Enak No. 123, Jakarta</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+62 812-3456-7890</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>info@tokorotihadi.com</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Toko Roti Hadi. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>