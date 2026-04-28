<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->getProdukWithKategori();
        return view('admin/produk/index', $data);
    }

    public function tambah()
    {
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();
        return view('admin/produk/tambah', $data);
    }

    public function simpan()
    {
        $produkModel = new ProdukModel();

        $rules = [
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = 'default.jpg';

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/produk', $namaGambar);
        }

        $produkModel->save([
            'nama_produk'  => $this->request->getPost('nama_produk'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
            'gambar'       => $namaGambar,
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        $data['produk'] = $produkModel->find($id);
        $data['kategori'] = $kategoriModel->findAll();

        if (!$data['produk']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/produk/edit', $data);
    }

    public function update($id)
    {
        $produkModel = new ProdukModel();

        $rules = [
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_produk'  => $this->request->getPost('nama_produk'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'stok'         => $this->request->getPost('stok'),
            'kategori_id'  => $this->request->getPost('kategori_id'),
        ];

        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Hapus gambar lama
            $produkLama = $produkModel->find($id);
            if ($produkLama['gambar'] !== 'default.jpg' && file_exists('uploads/produk/' . $produkLama['gambar'])) {
                unlink('uploads/produk/' . $produkLama['gambar']);
            }

            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/produk', $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $produkModel->update($id, $data);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diperbarui!');
    }

    public function hapus($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if ($produk['gambar'] !== 'default.jpg' && file_exists('uploads/produk/' . $produk['gambar'])) {
            unlink('uploads/produk/' . $produk['gambar']);
        }

        $produkModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus!');
    }
}