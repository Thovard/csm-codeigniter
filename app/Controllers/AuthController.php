<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class AuthController extends BaseController
{
    public function login(): string
    {
        return view('authentication/login');
    }
    public function register(): string
    {
        return view('authentication/cadastrar');
    }
    public function resetPassword(): string
    {
        return view('authentication/recuperar-senha');
    }
    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if ($this->request->getMethod() == 'POST') {
            if ($validation->withRequest($this->request)->run()) {
                $userModel = new UserModel();
                $userData = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                ];

                if ($userModel->save($userData)) {
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Usuário criado com sucesso!',
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Erro ao criar o usuário.',
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $validation->getErrors(),
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->request->getMethod(),
            ]);
        }
    }
    public function authUser()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ]);

        if ($this->request->getMethod() == 'POST') {
            if ($validation->withRequest($this->request)->run()) {
                $userModel = new UserModel();
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user = $userModel->where('email', $email)->first();
                if ($user && password_verify($password, $user['password'])) {
                    session()->set('user_id', $user['id']);
                    session()->set('user_name', $user['name']);
                    session()->setFlashdata('message', 'Login realizado com sucesso!');

                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Login realizado com sucesso!',
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'E-mail ou senha incorretos.',
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'E-mail ou senha incorretos.',
                ]);
            }
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Você foi desconectado com sucesso.');
    }
}
