<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\KeranjangModel;

class Keranjang extends BaseController
{
    public function index()
    {
        $keranjangModel = new KeranjangModel();
        $userId = session()->get('user_id');
        $data['keranjang'] = $keranjangModel->getKeranjangByUser($userId);
        
        $total = 0;
        foreach ($data['keranjang'] as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        $data['total'] = $total;

        return view('user/keranjang', $data);
    }

    public function tambah()
    {
        $keranjangModel = new KeranjangModel();
        $userId = session()->get('user_id');
        $produkId = $this->request->getPost('produk_id');
        $jumlah = $this->request->getPost('jumlah') ?? 1;

        // Cek apakah sudah ada di keranjang
        $existing = $keranjangModel->where('user_id', $userId)
                                   ->where('produk_id', $produkId)
                                   ->first();

        if ($existing) {
            $keranjangModel->update($existing['id'], [
                'jumlah' => $existing['jumlah'] + $jumlah
            ]);
        } else {
            $keranjangModel->save([
                'user_id'   => $userId,
                'produk_id' => $produkId,
                'jumlah'    => $jumlah,
            ]);
        }

        return redirect()->to('/user/keranjang')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update()
    {
        $keranjangModel = new KeranjangModel();
        $id = $this->request->getPost('id');
        $jumlah = $this->request->getPost('jumlah');

        if ($jumlah < 1) {
            $keranjangModel->delete($id);
        } else {
            $keranjangModel->update($id, ['jumlah' => $jumlah]);
        }

        return redirect()->to('/user/keranjang')->with('success', 'Keranjang diperbarui!');
    }

    public function hapus($id)
    {
        $keranjangModel = new KeranjangModel();
        $keranjangModel->delete($id);
        return redirect()->to('/user/keranjang')->with('success', 'Item dihapus dari keranjang!');
    }
}