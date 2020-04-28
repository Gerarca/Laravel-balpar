<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => 'Administrador',
            'description' => 'administrador',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Usuario',
            'description' => 'usuario',
        ]);
    }
}
