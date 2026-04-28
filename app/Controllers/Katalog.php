<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Katalog extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        $kategoriFilter = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');

        $builder = $produkModel->select('produk.*, kategori.nama_kategori')
                               ->join('kategori', 'kategori.id = produk.kategori_id', 'left');

        if ($kategoriFilter) {
            $builder->where('kategori_id', $kategoriFilter);
        }
        if ($search) {
            $builder->like('nama_produk', $search);
        }

        $data['produk'] = $builder->findAll();
        $data['kategori'] = $kategoriModel->findAll();
        $data['selectedKategori'] = $kategoriFilter;
        $data['search'] = $search;

        return view('katalog/index', $data);
    }

    public function detail($id)
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->getProdukById($id);

        if (!$data['produk']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['produk_lain'] = $produkModel->where('kategori_id', $data['produk']['kategori_id'])
                                           ->where('id !=', $id)
                                           ->limit(4)
                                           ->findAll();

        return view('katalog/detail', $data);
    }
}