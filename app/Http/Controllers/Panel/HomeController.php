<?php

namespace App\Http\Controllers\Panel;

use App\Complaint;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Suggestion;
use App\User;

class HomeController extends Controller
{

    public function index()
    {

        $data['users'] = User::all()->count();
        $data['shops'] = Shop::all()->count();
        $data['coupons'] = Coupon::all()->count();
        $data['complaint'] = Complaint::all()->count();
        $data['suggestion'] = Suggestion::all()->count();

        return view('panel.index' , $data );
    }
}
