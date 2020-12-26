<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{

    protected $path = 'shops';

    public function index()
    {
        return view('panel.shops.index');
    }

    public function create()
    {
        return view('panel.shops.create');
    }

    public function store(Request $request)
    {

        $data = $request->all();

        $validation = Validator::make($data, [
            'url' => 'required|url',
            'logo' => 'image',
            'coupon_logo' => 'image',
        ]);

        if ($validation->fails()) {
            return $this->response_api(false, $validation->errors()->first());
        }

        if ($file = $request->file('logo')) {
            $data['logo'] = $file->store($this->path);
        }
        if ($file = $request->file('coupon_logo')) {
            $data['coupon_logo'] = $file->store($this->path);
        }
        $item = Shop::create($data)->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }

    public function edit($id)
    {

        $data['item'] = Shop::findOrFail($id);
        return view('panel.shops.create', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();


        $validation = Validator::make($data, [
            'url' => 'required|url',
            'logo' => 'image',
        ]);

        if ($validation->fails()) {
            return $this->response_api(false, $validation->errors()->first());
        }
        if ($file = $request->file('logo')) {
            $data['logo'] = $file->store($this->path);
        }
        if ($file = $request->file('coupon_logo')) {
            $data['coupon_logo'] = $file->store($this->path);
        }

        $item = Shop::updateOrCreate(['id' => $id], $data)->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }


    public function destroy($id, Request $request)
    {
        $item = Shop::findOrFail($id);
        return $item->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');
    }


    public function datatable()
    {
        $items = Shop::query();
        return getDatatable($items, ['translations']);
    }

}
