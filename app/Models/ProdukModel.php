<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_produk', 'deskripsi', 'harga', 'stok', 'gambar', 'kategori_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getProdukWithKategori()
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = produk.kategori_id', 'left')
                    ->findAll();
    }

    public function getProdukById($id)
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = produk.kategori_id', 'left')
                    ->where('produk.id', $id)
                    ->first();
    }
}