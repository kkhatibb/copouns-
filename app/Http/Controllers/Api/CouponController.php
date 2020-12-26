<?php

namespace App\Http\Controllers\Api;

use App\Constants\StatusCodes;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Resources\CouponResource;
use App\UseFullCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CouponController extends Controller
{
    public function index(Request $request)
    {
        $items = Coupon::query()->filterApi($request)->paginate(15);
        $collection = CouponResource::collection($items);

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => $collection,
            'pagination' => [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage()
            ],
        ])->setStatusCode(StatusCodes::OK);
    }


    public function isUsefull(Request $request)
    {
        $item = Coupon::find($request->id);
        $item->updateNumberOfUsage();

        if (auth('api')->check()){
            if (!auth('api')->user()->usefullCoupons()->where('coupon_id' , $item->id)->exists()){
                UseFullCoupon::create([
                    'user_id'   => auth('api')->id(),
                    'coupon_id'   => $item->id,
                ]);
            }
        }

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => (new CouponResource($item)),
        ])->setStatusCode(StatusCodes::OK);
    }

    public function getUsefullCoupons()
    {
        $items = auth('api')->user()->usefullCoupons()->paginate(1);
        $collection = CouponResource::collection($items);

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => $collection,
            'pagination' => [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage()
            ],
        ])->setStatusCode(StatusCodes::OK);

    }

    public function fav(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'coupon_id' => 'required|exists:coupons,id'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'code' => StatusCodes::VALIDATION_ERROR,
                'message' => __('front.error'),
                'data' => [],
            ])->setStatusCode(StatusCodes::VALIDATION_ERROR);
        }

        if (auth('api')->user()->coupons()->where('coupon_id' ,$data['coupon_id'])->exists()){
            auth('api')->user()->coupons()->detach($data['coupon_id']);
        }else{
            auth('api')->user()->coupons()->attach($data['coupon_id']);
        }

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => [],
        ])->setStatusCode(StatusCodes::OK);
    }

    public function getAllFav()
    {
        $items = auth('api')->user()->coupons()->paginate(15);
        $collection = CouponResource::collection($items);
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => $collection,
            'pagination' => [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage(),
            ],
        ])->setStatusCode(StatusCodes::OK);
    }

}
