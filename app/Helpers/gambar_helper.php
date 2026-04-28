<?php

/**
 * Fungsi untuk mendapatkan URL gambar produk
 * Bisa handle URL lengkap (dari internet) dan file lokal
 */
function get_gambar_url($gambar)
{
    // Jika sudah berupa URL lengkap (http/https)
    if (strpos($gambar, 'http') === 0) {
        return $gambar;
    }

    // Jika file lokal ada
    $localPath = 'uploads/produk/' . $gambar;
    if ($gambar && $gambar !== 'default.jpg' && file_exists(FCPATH . $localPath)) {
        return base_url($localPath);
    }

    // Default placeholder
    return 'https://placehold.co/400x300/795548/FFFFFF?text=Roti+Hadi';
}