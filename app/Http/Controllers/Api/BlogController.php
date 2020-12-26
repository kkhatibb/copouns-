<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
        $items = Blog::query()->Visible(1)->paginate(15);

        $collection = BlogResource::collection($items);

        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => $collection,
            'pagination' => [
                'total' => $collection->total(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'total_pages' => $collection->lastPage()
            ],
        ])->setStatusCode(StatusCodes::OK);
    }

    public function show($id)
    {
        $item = Blog::query()->Visible(1)->find($id);
        $data = isset($item) ? new BlogResource($item) : [];
        return response([
            'status' => true,
            'code' => StatusCodes::OK,
            'message' => __('front.success'),
            'data' => $data,
        ])->setStatusCode(StatusCodes::OK);
    }
}
