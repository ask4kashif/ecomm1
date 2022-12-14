<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Cartalyst\Stripe\Api\Coupons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'=>'ABC123',
            'tyoe'=>'fixed',
            'value'=>30,
        ]);
        Coupon::create([
            'code'=>'DEF456',
            'tyoe'=>'percent',
            'percent_off'=>15,
        ]);
    }
}
