<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    protected $path = 'images';
    public function upload(Request $request)
    {
        if ($request->ajax()) {
            $file = $request->file('file');
            $path = $file->store($this->path);
            $image = Image::create([
                'name'  => $file->getClientOriginalName(),
                'size'  => $file->getSize(),
                'path'=>$path
            ]);

            return response()->json([
                'id' => $image->id
            ]);
        }
    }

    public function delete(Request $request)
    {
        $image = Image::find($request->get('id'));
        Storage::delete($image->path);
        $image->delete();
        return response()->json(['id' => $request->get('id') ]);
    }


}
