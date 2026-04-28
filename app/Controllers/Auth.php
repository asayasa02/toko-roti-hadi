<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Kalau sudah login, redirect sesuai role
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to(base_url('admin/dashboard'));
            }
            return redirect()->to(base_url('user/dashboard'));
        }

        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            session()->set([
                'user_id'    => $user['id'],
                'nama'       => $user['nama'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);

            // Redirect sesuai role
            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('admin/dashboard'));
            }
            return redirect()->to(base_url('user/dashboard'));
        }

        return redirect()->back()
                         ->with('error', 'Email atau password salah!');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/'));
        }
        return view('auth/register');
    }

    public function attemptRegister()
    {
        $userModel = new UserModel();

        $rules = [
            'nama'                => 'required|min_length[3]',
            'email'               => 'required|valid_email|is_unique[users.email]',
            'password'            => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                            $this->request->getPost('password'), 
                            PASSWORD_DEFAULT
                          ),
            'role'     => 'user',
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'    => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to(base_url('login'))
                         ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))
                         ->with('success', 'Berhasil logout.');
    }
}