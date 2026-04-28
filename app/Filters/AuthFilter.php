<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah sudah login
        if (!session()->get('isLoggedIn')) {
            // Simpan URL yang dituju sebelum redirect
            session()->set('redirect_url', current_url());
            return redirect()->to(base_url('login'))
                             ->with('error', 'Silakan login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, 
                          ResponseInterface $response, 
                          $arguments = null)
    {
    }
}