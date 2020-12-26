<?php

namespace App\Http\Controllers\Panel;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Replay;
use App\Requests\ReplayRequest;
use Illuminate\Support\Facades\Mail;

class ReplayController extends Controller
{

    public function store(ReplayRequest $request)
    {
        $replay = Replay::create($request->all());
        Mail::send(new ContactMail($replay));
        return response()->json([
            'status' => StatusCodes::OK,
            'msg' => trans('front.success')
        ], StatusCodes::OK);
    }



}
