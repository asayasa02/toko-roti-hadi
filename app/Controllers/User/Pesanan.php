<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $userId = session()->get('user_id');
        $data['pesanan'] = $orderModel->getOrdersByUser($userId);
        return view('user/pesanan', $data);
    }

    public function detail($id)
    {
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
        $userId = session()->get('user_id');

        $data['order'] = $orderModel->where('user_id', $userId)->find($id);
        if (!$data['order']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['detail'] = $orderDetailModel->getDetailByOrder($id);
        return view('user/pesanan_detail', $data);
    }
}