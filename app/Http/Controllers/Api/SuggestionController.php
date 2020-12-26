<?php

namespace App\Http\Controllers\Api;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Requests\SuggestionRequest;
use App\Suggestion;

class SuggestionController extends Controller
{


    public function store(SuggestionRequest $request)
    {

        Suggestion::create($request->all());

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.msgSent'),
            'data' => [],
        ])->setStatusCode(StatusCodes::OK);

    }

}
