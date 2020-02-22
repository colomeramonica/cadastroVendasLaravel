<?php

use Illuminate\Database\Seeder;

class VendedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Vendedores::class, 30)->create();
    }
}
