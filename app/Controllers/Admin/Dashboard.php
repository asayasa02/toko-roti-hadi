<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $orderModel = new OrderModel();
        $userModel = new UserModel();

        $data['total_produk'] = $produkModel->countAll();
        $data['total_pesanan'] = $orderModel->countAll();
        $data['total_user'] = $userModel->where('role', 'user')->countAllResults();
        $data['pesanan_pending'] = $orderModel->where('status', 'pending')->countAllResults();
        
        $data['pendapatan'] = $orderModel->where('status', 'selesai')
                                         ->selectSum('total_harga')
                                         ->first()?->total_harga ?? 0;

        $data['pesanan_terbaru'] = $orderModel->getOrdersWithUser();
        $data['pesanan_terbaru'] = array_slice($data['pesanan_terbaru'], 0, 5);

        return view('admin/dashboard', $data);
    }
}