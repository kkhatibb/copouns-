<?php

namespace App\Http\Controllers\Api;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {

        $settings = [
            'whatsapp'  => getSetting('whatsapp'),
            'facebook'  => getSetting('facebook'),
            'twitter'  => getSetting('twitter'),
            'instagram'  => getSetting('instagram'),
            'email'  => getSetting('email'),
            'googleplay'  => getSetting('googleplay'),
            'appstore'  => getSetting('appstore'),
        ];

        return response([
                'status' => true,
                'code' => StatusCodes::OK,
                'message' => __('front.success'),
                'data' => $settings,
            ])->setStatusCode(StatusCodes::OK);
    }
}
