<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'total_harga', 'status', 'alamat_pengiriman', 'catatan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOrdersWithUser()
    {
        return $this->select('orders.*, users.nama, users.email')
                    ->join('users', 'users.id = orders.user_id')
                    ->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }

    public function getOrdersByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}