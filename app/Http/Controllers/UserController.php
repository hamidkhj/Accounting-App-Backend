<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function list () {
        $users = User::with('role')->get()->toJson();

        return $users;

    }

    public function store(Request $request)
    {
        // return $request->all();
        $validation = $this->validation($request);
        if($validation->fails()){
            return response()->json($validation->messages());
        }else{
            $data = $validation->validated();
            $data["password"] = bcrypt('password');
            $user = User::create($data);
            $user->locations()->sync($request->locationIds);
            $user->services()->sync($request->serviceIds);

            return $user;
        }
    }
    
    public function validation($request)
    {
        $validation = Validator::make($request->all(), [
            'group_id'=> 'integer|required',
            'title_id'=> 'integer|required',
            'marital_status_id'=> 'integer|required',
            'user_name'=> 'string|required|unique:users,user_name',
            'first_name'=> 'string|required',
            'last_name'=> 'string|required',
            'father_name'=> 'string|required',
            'birthday'=> 'date|required',
            'address'=> 'string|required',
            'phone'=> 'integer|required',
            'personal_code'=> 'integer|required',
            'gender'=> 'string|required',
            'meli_code'=> 'integer|required',
            'static_ip'=> 'string|nullable',
            'email'=> 'email|required',
            'org_email'=> 'email|required',
            'is_active'=> 'boolean|required',
            'major'=> 'string|required',
            'passport'=> 'integer|nullable',
            'mobile1'=> 'integer|required',
            'mobile2'=> 'integer|nullable',
            'comment'=> 'string|nullable',
            'city'=> 'string|required',
            'exp_date'=> 'date|required',
            'hour_limit'=> 'integer|nullable',
            'connection_number'=> 'integer|nullable',
            'mac_address'=> 'string|nullable',
            'bandwidth_limit'=> 'integer|nullable',
        ]);

        return $validation;
    }
}
