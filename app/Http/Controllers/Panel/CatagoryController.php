<?php

namespace App\Http\Controllers\Panel;

use App\Catagory;
use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatagoryController extends Controller
{

    protected $path = 'shops';

    public function index()
    {
        return view('panel.catagories.index');
    }

    public function create()
    {
        return view('panel.catagories.create');
    }

    public function store(Request $request)
    {
        $item = Catagory::create($request->only(Catagory::FILLABLE))->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }

    public function edit($id)
    {

        $data['item'] = Catagory::findOrFail($id);
        return view('panel.catagories.create', $data);
    }

    public function update(Request $request, $id)
    {
        $item = Catagory::updateOrCreate(['id' => $id], $request->only(Catagory::FILLABLE))->createTranslation($request);
        return isset($item) ? $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح') : $this->response_api(false, 'حدث خطأ أثناء حفظ البيانات');
    }


    public function destroy($id, Request $request)
    {
        $item = Catagory::findOrFail($id);
        return $item->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');
    }


    public function datatable()
    {
        $items = Catagory::query();
        return getDatatable($items, ['translations']);
    }

}
