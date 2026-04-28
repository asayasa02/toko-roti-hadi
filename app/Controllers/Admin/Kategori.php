<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        return view('admin/kategori/index', $data);
    }

    public function simpan()
    {
        $kategoriModel = new KategoriModel();
        $kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update($id)
    {
        $kategoriModel = new KategoriModel();
        $kategoriModel->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ]);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $kategoriModel = new KategoriModel();
        $kategoriModel->delete($id);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}