<?php

namespace App\Http\Controllers\Panel;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{

    protected $path = 'shops';

    public function index()
    {
        return view('panel.coupons.index');
    }

    public function create()
    {
        return view('panel.coupons.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'coupon' => 'required|string',
            'shop_id' => 'required|exists:shops,id',
            'catagory_id' => 'required|exists:catagories,id',
            'numberOfUsage' => 'nullable|numeric|min:0',
        ]);

        if ($validation->fails()) {
            return $this->response_api(false, $validation->errors()->first());
        }

        $item = Coupon::create($request->only(Coupon::FILLABLE))->createTranslation($request);

        if ($request->filled('slider_images')) {
            $sliderImages = explode(',', $request->slider_images);

            foreach ($sliderImages as $imageId) {
                $image = Image::find($imageId);
                if (isset($image)) {
                    $image->update([
                        'owner_type' => get_class($item) ,
                        'owner_id' => $item->id
                    ]);
                }
            }
        }


        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }

    public function edit($id)
    {

        $data['item'] = Coupon::findOrFail($id);
        return view('panel.coupons.create', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validation = Validator::make($data, [
            'coupon' => 'required|string',
            'shop_id' => 'required|exists:shops,id',
            'catagory_id' => 'required|exists:catagories,id',
            'numberOfUsage' => 'nullable|numeric|min:0',
        ]);

        if ($validation->fails()) {
            return $this->response_api(false, $validation->errors()->first());
        }


        $item = Coupon::updateOrCreate(['id' => $id], $request->only(Coupon::FILLABLE))->createTranslation($request);


        if ($request->filled('slider_images')) {
            $sliderImages = explode(',', $request->slider_images);
            $item->sliderImages()->whereNotIn('id' , $sliderImages)->delete();
            foreach ($sliderImages as $imageId) {
                $image = Image::find($imageId);
                if (isset($image)) {
                    $image->update([
                        'owner_type' => get_class($item) ,
                        'owner_id' => $item->id
                    ]);
                }
            }
        }


        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }


    public function destroy($id, Request $request)
    {
        $item = Coupon::findOrFail($id);
        return $item->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');
    }


    public function datatable()
    {
        $items = Coupon::query();
        return getDatatable($items, ['translations' , 'shop' , 'catagory']);
    }

}
