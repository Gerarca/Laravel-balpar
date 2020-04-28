<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Carlos Sosa',
            'email' => 'carlos.sosa@porta.com.py',
            'password' => bcrypt('12345'),
        ])->roles()->attach(1);
        User::create([
          'id' => 2,
          'name' => 'Desarrollo Porta',
          'email' => 'desarrollo@porta.com.py',
          'password' => bcrypt('desarrollo'),
          ])->roles()->attach(1);

    }
}
