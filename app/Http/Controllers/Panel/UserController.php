<?php

namespace App\Http\Controllers\Panel;

use App\Constants\StatusCodes;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        return view('panel.users.index');
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => StatusCodes::VALIDATION_ERROR,
                'msg' => $validator->errors()->first()
            ], StatusCodes::VALIDATION_ERROR);
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return response()->json([
            'msg' => 'تمت عملية الإضافة بنجاح'
        ], 200);
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view('panel.users.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $id .'|unique:admins,email',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' =>StatusCodes::VALIDATION_ERROR,
                'msg' => $validator->errors()->first()
            ], StatusCodes::VALIDATION_ERROR);
        }

        if ($request->filled('password')){
            $data['password'] = Hash::make($data['password']);
        }else{
            $data['password'] = $user->password;
        }
        $user->update($data);

        return response()->json([
            'msg' => 'تمت عملية التعديل بنجاح'
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        return $user->delete() ? $this->response_api(true, 'تمت العملية بنجاح') : $this->response_api(false, 'لقد حدث خطأ ما');

    }


    public function datatable()
    {
        $items = User::query();
        return getDatatable($items);
    }
}
