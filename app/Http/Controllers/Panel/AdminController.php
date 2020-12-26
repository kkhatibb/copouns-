<?php

namespace App\Http\Controllers\Panel;

use App\Admin;
use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('panel.admins.index' );
    }

    public function create()
    {
        return view('panel.admins.create');
    }

    public function store(AdminRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        Admin::create($data);

        return response()->json([
            'msg' => 'تمت عملية الإضافة بنجاح'
        ], StatusCodes::OK);

    }

    public function edit($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view('panel.admins.edit', $data);
    }

    public function update(AdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $data = $request->all();

        if (!$request->filled('password')) {
            $data['password'] = $admin->password;
        }else{
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);

        return $this->response_api(true, 'تمت عملية حفظ البيانات بنجاح');
    }

    public function destroy($id)
    {
        $item = Admin::findOrFail($id);
        return $item->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');

    }

    public function datatable()
    {
        $items = Admin::query();
        return getDatatable($items);
    }
    public function showProfile()
    {
        return view('panel.profile');
    }

    public function updateProfile(Request $request)
    {
        $admin = auth('admin')->user();
        $data = $request->all();
        $validation = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validation->errors()->first()
            ], StatusCodes::VALIDATION_ERROR);
        }

        if (!$request->filled('password')) {
            $data['password'] = $admin->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $admin->update($data);

        return $this->response_api(true, __('front.success'), StatusCodes::OK);

    }
}
