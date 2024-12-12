<?php

namespace App\Database\Seeds;

use App\Models\CustomerModel;
use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Segmentos
        $segments = ['Tecnologia', 'Alimentação', 'Saúde', 'Transporte'];

        // Cria 3 customers para cada segmento
        foreach ($segments as $segment) {
            for ($i = 1; $i <= 3; $i++) {

                $customer = [
                    'user_id' => 1,
                    'nome' => "Customer $segment $i",
                    'email' => "customer$segment$i@example.com",
                    'phone' => "123456789$i",
                    'segmento' => $segment,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $customerModel = new CustomerModel();
                $customerModel->insert($customer);
            }
        }
    }
}
