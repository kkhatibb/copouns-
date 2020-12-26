<?php

namespace App\Http\Controllers\Panel;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Suggestion;
use Illuminate\Support\Facades\Request;

class SuggestionController extends Controller
{


    public function index()
    {
        return view('panel.suggestions.index');
    }

    public function show($id)
    {
        $data['item'] = Suggestion::findOrFail($id);
        $data['item']->updateReadAt();
        return view('panel.suggestions.show', $data);
    }

    public function destroy($id, Request $request)
    {
        if ($request->json()) {
            try {
                Suggestion::destroy($id);
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

        $items = Suggestion::orderByDesc('created_at');

        return getDatatable($items , ['shop']);

    }



}
