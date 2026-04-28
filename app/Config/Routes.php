<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================================================
// PUBLIC ROUTES - Tidak perlu login
// ================================================
$routes->get('/', 'Home::index');
$routes->get('katalog', 'Katalog::index');
$routes->get('katalog/detail/(:num)', 'Katalog::detail/$1');

// ================================================
// AUTH ROUTES - Tidak pakai filter
// ================================================
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// ================================================
// USER ROUTES - Pakai filter auth
// ================================================
$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'User\Dashboard::index');
    $routes->get('keranjang', 'User\Keranjang::index');
    $routes->post('keranjang/tambah', 'User\Keranjang::tambah');
    $routes->post('keranjang/update', 'User\Keranjang::update');
    $routes->get('keranjang/hapus/(:num)', 'User\Keranjang::hapus/$1');
    $routes->get('checkout', 'User\Checkout::index');
    $routes->post('checkout/proses', 'User\Checkout::proses');
    $routes->get('pesanan', 'User\Pesanan::index');
    $routes->get('pesanan/detail/(:num)', 'User\Pesanan::detail/$1');
});

// ================================================
// ADMIN ROUTES - Pakai filter admin
// ================================================
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Produk
    $routes->get('produk', 'Admin\Produk::index');
    $routes->get('produk/tambah', 'Admin\Produk::tambah');
    $routes->post('produk/simpan', 'Admin\Produk::simpan');
    $routes->get('produk/edit/(:num)', 'Admin\Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Admin\Produk::update/$1');
    $routes->get('produk/hapus/(:num)', 'Admin\Produk::hapus/$1');

    // Kategori
    $routes->get('kategori', 'Admin\Kategori::index');
    $routes->post('kategori/simpan', 'Admin\Kategori::simpan');
    $routes->post('kategori/update/(:num)', 'Admin\Kategori::update/$1');
    $routes->get('kategori/hapus/(:num)', 'Admin\Kategori::hapus/$1');

    // Pesanan
    $routes->get('pesanan', 'Admin\Pesanan::index');
    $routes->get('pesanan/detail/(:num)', 'Admin\Pesanan::detail/$1');
    $routes->post('pesanan/updateStatus/(:num)', 'Admin\Pesanan::updateStatus/$1');
});