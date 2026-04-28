<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'produk_id', 'jumlah'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';

    public function getKeranjangByUser($userId)
    {
        return $this->select('keranjang.*, produk.nama_produk, produk.harga, produk.gambar, produk.stok')
                    ->join('produk', 'produk.id = keranjang.produk_id')
                    ->where('keranjang.user_id', $userId)
                    ->findAll();
    }

    public function getCartCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }
}