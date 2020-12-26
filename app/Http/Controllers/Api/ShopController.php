<?php

namespace App\Http\Controllers\Api;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $items = Shop::all();

        return response([
                'status' => true,
                'code' => StatusCodes::OK,
                'message' => __('front.success'),
                'data' => ShopResource::collection($items),
            ])->setStatusCode(StatusCodes::OK);
    }
}
