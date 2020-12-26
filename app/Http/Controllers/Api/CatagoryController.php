<?php

namespace App\Http\Controllers\Api;

use App\Catagory;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\CatagoryResource;

class CatagoryController extends Controller
{
    public function index()
    {
        $items = Catagory::all();

        return response([
                'status' => true,
                'code' => StatusCodes::OK,
                'message' => __('front.success'),
                'data' => CatagoryResource::collection($items),
            ])->setStatusCode(StatusCodes::OK);
    }
}
