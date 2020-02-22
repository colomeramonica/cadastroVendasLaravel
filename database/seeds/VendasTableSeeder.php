<?php

use Illuminate\Database\Seeder;

class VendasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Venda::class, 30)->create();
    }
}
