<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $table = 'order_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'produk_id', 'jumlah', 'harga', 'subtotal'];

    public function getDetailByOrder($orderId)
    {
        return $this->select('order_detail.*, produk.nama_produk, produk.gambar')
                    ->join('produk', 'produk.id = order_detail.produk_id')
                    ->where('order_id', $orderId)
                    ->findAll();
    }
}