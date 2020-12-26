<?php

namespace App\Http\Controllers\Api;

use App\Complaint;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Requests\ComplaintRequest;

class ComplaintController extends Controller
{


    public function store(ComplaintRequest $request)
    {

        Complaint::create($request->all());

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.msgSent'),
            'data' => [],
        ])->setStatusCode(StatusCodes::OK);

    }

}
