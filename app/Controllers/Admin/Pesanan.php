<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;

class Pesanan extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $data['pesanan'] = $orderModel->getOrdersWithUser();
        return view('admin/pesanan/index', $data);
    }

    public function detail($id)
    {
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();

        $data['order'] = $orderModel->select('orders.*, users.nama, users.email, users.no_hp')
                                    ->join('users', 'users.id = orders.user_id')
                                    ->find($id);

        if (!$data['order']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['detail'] = $orderDetailModel->getDetailByOrder($id);
        return view('admin/pesanan/detail', $data);
    }

    public function updateStatus($id)
    {
        $orderModel = new OrderModel();
        $status = $this->request->getPost('status');
        $orderModel->update($id, ['status' => $status]);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}