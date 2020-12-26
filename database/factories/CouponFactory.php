<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Coupon::class, function (Faker $faker) {

    $catagories = \App\Shop::query()->pluck('id')->toArray();
    $shops = \App\Shop::query()->pluck('id')->toArray();


    return [
        'shop_id' => $shops[array_rand($shops)],
        'catagory_id' => $catagories[array_rand($catagories)],
        'coupon' => $faker->name,
        'numberOfUsage' => $faker->numberBetween(10000 , 99999),
    ];
});

