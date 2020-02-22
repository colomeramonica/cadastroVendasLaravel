<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Venda::class, function (Faker $faker) {
    $totalVenda = $faker->numberBetween($min = 0.0, $max = 10.000);
    return [
        'total_venda' => $totalVenda,
        'comissao' => (8.5 / 100) * $totalVenda,
        'id_vendedor' => function () {
            return factory(App\Vendedores::class)->create()->id;
        }
    ];
});
