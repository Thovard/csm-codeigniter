<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $user_name = $session->get('user_name');

        if (!$user_id) {
            return redirect()->to('/login');
        }

        $customerModel = new CustomerModel();

        $data = $customerModel->select('segmento, COUNT(*) as total')
            ->where('user_id', $user_id)
            ->groupBy('segmento')
            ->findAll();

        return view('dashboard/dash', ['data' => $data, 'name' => $user_name]);
    }
    public function newUser()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $user_name = $session->get('user_name');

        $customerModel = new CustomerModel();
        $customers = $customerModel->getCustomersByUserId($user_id);
        return view('dashboard/users', [
            'name' => $user_name,
            'customers' => $customers
        ]);
    }
    public function storeCustomer()
    {
        $session = session();
        $user_id = $session->get('user_id');
    
        $customerModel = new CustomerModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]',
            'segmento' => 'required'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $validation->getErrors()]);
        }
    
        $data = [
            'user_id' => $user_id,
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'segmento' => $this->request->getPost('segmento')
        ];
    
        $customerModel->save($data);
    
        return $this->response->setJSON(['success' => 'Cliente cadastrado com sucesso!']);
    }
    public function editCustomer($id)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);
        
        if ($customer) {
            return $this->response->setJSON($customer);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Cliente não encontrado']);
        }
    }
    public function updateCustomer($id)
    {
        $customerModel = new CustomerModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nome' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]',
            'segmento' => 'required'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $validation->getErrors()]);
        }
    
        $data = [
            'nome' => $this->request->getPost('nome'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'segmento' => $this->request->getPost('segmento')
        ];
    
        $customerModel->update($id, $data);
    
        return $this->response->setJSON(['success' => 'Cliente atualizado com sucesso!']);
    }
    public function deleteCustomer($id)
    {
        $customerModel = new CustomerModel();
        $customerModel->delete($id);

        return redirect()->to('/dashboard/users')->with('success', 'Cliente excluído com sucesso!');
    }
}
