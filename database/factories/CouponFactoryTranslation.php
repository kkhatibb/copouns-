<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\CouponTranslation::class, function (Faker $faker) {

    $coupon = factory(App\Coupon::class)->create();

    foreach (locales() as $key => $value){
        App\CouponTranslation::create([
            'coupon_id' =>$coupon['id'],
            'locale' => $key,
            'description' => $faker->paragraph(rand(20,30)),
        ]);
    }

    return [];


});
