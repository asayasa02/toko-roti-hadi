<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\KeranjangModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $keranjangModel = new KeranjangModel();
        $userId = session()->get('user_id');

        $data['total_pesanan'] = count($orderModel->getOrdersByUser($userId));
        $data['pesanan_aktif'] = $orderModel->where('user_id', $userId)
                                            ->whereIn('status', ['pending', 'diproses', 'dikirim'])
                                            ->countAllResults();
        $data['item_keranjang'] = $keranjangModel->getCartCount($userId);
        $data['pesanan_terbaru'] = $orderModel->where('user_id', $userId)
                                              ->orderBy('created_at', 'DESC')
                                              ->limit(5)
                                              ->findAll();

        return view('user/dashboard', $data);
    }
}