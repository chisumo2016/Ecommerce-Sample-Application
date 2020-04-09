<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [

        'title' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomFloat(2, 0, 10000),
        'image_path' =>"https://via.placeholder.com/150"

    ];
});
