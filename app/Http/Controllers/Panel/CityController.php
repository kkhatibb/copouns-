<?php

namespace App\Http\Controllers\Panel;

use App\City;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CityController extends Controller
{


    public function index()
    {
        return view('panel.cities.index');
    }

    public function create()
    {
        return view('panel.cities.create');
    }

    public function store(Request $request)
    {
        $item = City::create($request->only(City::FILLABLE))->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }

    public function edit($id)
    {
        $data['item'] = City::findOrFail($id);
        return view('panel.cities.create' ,$data);
    }

    public function update(Request $request, $id)
    {
        $item = City::updateOrCreate(['id' => $id], $request->only(City::FILLABLE))->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }


    public function destroy($id, Request $request)
    {
        $city = City::findOrFail($id);
        return $city->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');
    }



    public function datatable()
    {
        $items = City::query();
        return getDatatable($items , ['translations']);
    }


}
