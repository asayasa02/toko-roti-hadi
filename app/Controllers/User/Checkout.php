<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\ProdukModel;

class Checkout extends BaseController
{
    public function index()
    {
        $keranjangModel = new KeranjangModel();
        $userId = session()->get('user_id');
        $data['keranjang'] = $keranjangModel->getKeranjangByUser($userId);

        if (empty($data['keranjang'])) {
            return redirect()->to('/user/keranjang')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($data['keranjang'] as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        $data['total'] = $total;

        return view('user/checkout', $data);
    }

    public function proses()
    {
        $keranjangModel = new KeranjangModel();
        $orderModel = new OrderModel();
        $orderDetailModel = new OrderDetailModel();
        $produkModel = new ProdukModel();

        $userId = session()->get('user_id');
        $keranjang = $keranjangModel->getKeranjangByUser($userId);

        if (empty($keranjang)) {
            return redirect()->to('/user/keranjang')->with('error', 'Keranjang kosong!');
        }

        $totalHarga = 0;
        foreach ($keranjang as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

        // Simpan order
        $orderModel->save([
            'user_id'           => $userId,
            'total_harga'       => $totalHarga,
            'status'            => 'pending',
            'alamat_pengiriman' => $this->request->getPost('alamat'),
            'catatan'           => $this->request->getPost('catatan'),
        ]);

        $orderId = $orderModel->getInsertID();

        // Simpan detail order dan update stok
        foreach ($keranjang as $item) {
            $orderDetailModel->save([
                'order_id'  => $orderId,
                'produk_id' => $item['produk_id'],
                'jumlah'    => $item['jumlah'],
                'harga'     => $item['harga'],
                'subtotal'  => $item['harga'] * $item['jumlah'],
            ]);

            // Update stok
            $produk = $produkModel->find($item['produk_id']);
            $produkModel->update($item['produk_id'], [
                'stok' => $produk['stok'] - $item['jumlah']
            ]);
        }

        // Kosongkan keranjang
        $keranjangModel->where('user_id', $userId)->delete();

        return redirect()->to('/user/pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }
}