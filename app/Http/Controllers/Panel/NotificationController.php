<?php

namespace App\Http\Controllers\Panel;

use App\Constants\StatusCodes;
use App\Deal;
use App\Http\Controllers\Controller;
use App\Notifications\MobileNotification;
use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Validator;

class NotificationController extends Controller
{


    public function create()
    {
        $data['shops'] = Shop::all();
        return view('panel.notifications.create' , $data);
    }

    public function storeAndSend(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required',
            'shop_id' => 'required|exists:shops,id',
        ]);

        if ($validator->fails()){
            return $this->response_api(false, $validator->errors()->first());
        }


        $users = User::all();
        Notification::send($users , new MobileNotification($data['title'] , $data['description'] , @$data['shop_id']  , 'admin_notifications'));

        return  $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح');

    }



}
