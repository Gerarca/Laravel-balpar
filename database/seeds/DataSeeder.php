<?php

use Illuminate\Database\Seeder;
use App\Data;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::create([
            'id' => 1,
            'key' => 'nosotros',
            'value' => (object) [
                'video' => ''
            ]
        ]);
    }
}
