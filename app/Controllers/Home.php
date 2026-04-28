<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        
        $data['produk_unggulan'] = $produkModel->getProdukWithKategori();
        $data['produk_unggulan'] = array_slice($data['produk_unggulan'], 0, 4);
        
        return view('home', $data);
    }
}