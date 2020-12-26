<?php

namespace App\Http\Controllers\Panel;

use App\Blog;
use App\Catagory;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\CatagoryRequest;


class BlogController extends Controller
{


    public function index()
    {
        $data['title'] = 'المدونة';
        return view('panel.blogs.index' , $data);
    }

    public function create()
    {
        $data['title'] = 'إضافة';
        return view('panel.blogs.create' , $data);
    }

    public function store(BlogRequest $request)
    {
        $data = $request->only(Blog::FILLABLE);
        if ($file = $request->file('image')){
            $data['image'] = $file->store('images');
        }
        $item = Blog::create($data)->createTranslation($request);
        return $this->response_api(true, __('front.success'), StatusCodes::OK);
    }

    public function edit($id)
    {
        $data['title'] = 'تعديل';
        $data['catagories'] = Catagory::all();
        $data['item'] = Blog::findOrFail($id);
        return view('panel.blogs.create', $data);
    }

    public function update(BlogRequest $request, $id)
    {
        $data = $request->only(Blog::FILLABLE);
        if ($file = $request->file('image')){
            $data['image'] = $file->store('images');
        }
        $item = Blog::updateOrCreate(['id' => $id ] , $data)->createTranslation($request);
        return $this->response_api(true, __('front.success'), StatusCodes::OK);

    }

    public function destroy($id)
    {
        $admin = Blog::find($id);
        return $admin->delete() ? $this->response_api(true, __('front.success'), StatusCodes::OK) : $this->response_api(true, __('front.error'), StatusCodes::INTERNAL_ERROR);
    }

    public function datatable()
    {
        $items = Blog::query();
        return getDatatable($items);
    }


}
