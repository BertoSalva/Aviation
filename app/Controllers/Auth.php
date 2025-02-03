<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user', $user);
            session()->set('isLoggedIn', true);
            return redirect()->to('/customers');
        } else {
            session()->setFlashdata('error', 'Invalid email or password.');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
