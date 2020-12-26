<?php

use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupon = factory(App\CouponTranslation::class, 50)->create();
//        $users = factory(App\User::class, 3)
//            ->create()

    }
}
