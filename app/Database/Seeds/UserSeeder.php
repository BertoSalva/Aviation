<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('password123', PASSWORD_DEFAULT);

        $data = [
            'email'    => 'admin@chapp.com',
            'password' => $password,
        ];

        $this->db->table('users')->insert($data);
    }
}
