<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        if (!Route::is('panel.*')){
            if ($request->expectsJson()){
                if ($request->header('Accept-Language') <> '') {
                    \App::setLocale($request->header('Accept-Language'));
                }
            }
        }
    }
    function response_api($status, $message, $items = null)
    {
        $response = ['status' => $status, 'message' => $message];
        if ($status && isset($items)) {
            $response['item'] = $items;
        } else {
            $response['errors_object'] = $items;
        }
        return response()->json($response);
    }

    public function photo($folder , $path , $size = null)
    {

        $path = storage_path("app/$folder/".$path);

        if(!File::exists($path)) abort(404);

        $file = File::get($path);
        $type = File::mimeType($path);


        if ($size != null){
            $size = explode('x' , $size);
            if(is_numeric($size[0]) && is_numeric($size[1])){
                $width = $size[0];
                $height = $size[1];
                $manager = new \Intervention\Image\ImageManager();
                $image = $manager->make($file)->fit($width, $height, function ($constraint) {
                    $constraint->upsize();
                });

                $response = Response::make($image->encode($image->mime), 200);

                $response->header("CF-Cache-Status", 'HIF');
                $response->header("Cache-Control", 'max-age=604800, public');
                $response->header("Content-Type", $type);

                return $response;
            }else{
                abort(404);
            }
        }else{
            $manager = new \Intervention\Image\ImageManager();
            $image = $manager->make($file);

            $response = Response::make($image->encode($image->mime), 200);

            $response->header("CF-Cache-Status", 'HIF');
            $response->header("Cache-Control", 'max-age=604800, public');
            $response->header("Content-Type", $type);

            return $response;
        }
    }
}
