<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrcreate(
            ['email'=> 'admin@api.com'],
            [
                'name'=>'Administrador',
                'password'=>Hash.make('password'),
                'role'=> user.ROLE_ADMIN,
            ]
        );

    User ::updateOrcreate(
        ['email'=> 'Usuario@api.com'],
        [
            'name'=> 'Usuario consulta',
            'password'=> Hash::make ('password'),
            'role' => User::ROLE_USUARIO,
        ]
     );
    }
}
