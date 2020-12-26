<?php

namespace App\Http\Controllers\panel;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index()
    {
        return view('panel.cities.countries');
    }


    public function store(CountryRequest $request)
    {
        $data = $request->all();

        Country::create($data);
        return response()->json([
            'status' => 200,
            'msg' => 'تمت العملية بنجاح'
        ], 200);
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $data = $request->all();

        $country->update($data);
        return response()->json([
            'status' => 200,
            'msg' => 'تمت العملية بنجاح'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $country = Country::findOrFail($id);

            $country->delete();

            return response()->json([
                'status' => 200,
                'msg' => 'تمت العملية بنجاح'
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'msg' => 'لقد حدث خطأ ما'
            ], 500);
        }

    }

    public function deleteSelected(Request $request)
    {
        try {
            $ids = $request->ids;

            Country::query()->whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 200,
                'msg' => 'تمت العملية بنجاح'
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'msg' => 'لقد حدث خطأ ما'
            ], 500);
        }
    }

    public function datatable()
    {
        $items = Country::query();
        return getDatatable($items, ['translations']);
    }

}
