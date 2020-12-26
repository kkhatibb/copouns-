<?php

namespace App\Http\Controllers\Panel;

use App\Complaint;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{


    public function index()
    {
        return view('panel.complaint.index');
    }

    public function show($id)
    {
        $data['item'] = Complaint::findOrFail($id);
        $data['item']->updateReadAt();
        return view('panel.complaint.show', $data);
    }

    public function destroy($id, Request $request)
    {
        if ($request->json()) {
            try {
                Complaint::destroy($id);
                return response()->json([
                    'status' => StatusCodes::OK,
                    'message' => trans('front.success')
                ], StatusCodes::OK);

            } catch (\Exception $exception) {
                return response()->json([
                    'status' => StatusCodes::INTERNAL_ERROR,
                    'msg' => trans('front.error')
                ], StatusCodes::INTERNAL_ERROR);
            }
        }
    }

    public function datatable()
    {

        $items = Complaint::orderByDesc('created_at');

        return getDatatable($items);

    }



}
