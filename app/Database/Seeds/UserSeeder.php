<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
        ];
        $this->db->table('users')->insert($data);
    }
}