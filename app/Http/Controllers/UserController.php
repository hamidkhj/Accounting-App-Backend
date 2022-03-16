<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;



class UserController extends Controller
{
    public function list () {
        $users = User::with('role')->get()->toJson();

        return $users;

    }

    public function store(Request $request)
    {
        App::setlocale('fa');
        $validation = $this->validation($request);
        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        }else{
            $data = $validation->validated();
            $data["password"] = bcrypt('password');
            $user = User::create($data);
            $user->locations()->sync($request->locationIds);
            $user->services()->sync($request->serviceIds);

            return $user;
        }
    }

    public function editUser (Request $request) {
        App::setlocale('fa');
        $validation = $this->validation($request);

        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        }else{
            $data = $validation->validated();
            // $data["password"] = bcrypt('password');
            $user = User::find($request['id']);
            $user->update($data);
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
            'user_name'=> 'string|required|unique:users,user_name,'.$request->id,
            'first_name'=> 'string|required',
            'last_name'=> 'string|required',
            'father_name'=> 'string|required',
            'birthday'=> 'date|required',
            'address'=> 'string|required',
            'phone'=> 'integer|required',
            'personal_code'=> 'integer|required',
            'gender'=> 'string|required',
            'meli_code'=> 'integer|required',
            'static_ip'=> 'string|nullable|unique:users,static_ip,'.$request->id,
            'email'=> 'email|required',
            'org_email'=> 'email|nullable',
            'is_active'=> 'boolean|required',
            'major'=> 'string|nullable',
            'passport'=> 'integer|nullable',
            'mobile1'=> 'integer|required',
            'mobile2'=> 'integer|nullable',
            'comment'=> 'string|nullable',
            'city'=> 'string|nullable',
            'exp_date'=> 'date|required',
            'ip_exp_date'=> 'required_with:static_ip|date|nullable',
            'hour_limit'=> 'integer|nullable',
            'connection_number'=> 'integer|nullable',
            'mac_address'=> 'string|nullable',
            'bandwidth_limit'=> 'integer|nullable',
        ]);

        return $validation;
    }


    public function searchUsers (Request $request) {


        $users = [];
        $gpId = $request['groupId'];
        $meli = $request['meliCode'];
        $phone = $request['phone'];
        $stCode = $request['stdn'];
        $lname = $request['lastName'];
        $fname = $request['firstName'];
        $this->location = $request['location'];

        $users = User::with('group', 'locations', 'services')
        ->when($gpId, function ($query, $gpId) {
            $query->where('group_id', $gpId);
        })
        ->when($meli, function ($query, $meli) {
            $query->where('meli_code', $meli);
        })
        ->when($stCode, function ($query, $stCode) {
            $query->where('personal_code', $stCode);
        })
        ->when($phone, function ($query, $phone) {
            $query->where('mobile1', $phone);
        })
        ->when($fname, function ($query, $fname) {
            $query->where('first_name', 'like' , '%'.$fname.'%');
        })
        ->when($lname, function ($query, $lname) {
            $query->where('last_name', 'like' , '%'.$lname.'%');
        })->when ($this->location, function ($query) {
            $query->whereHas('locations', function ($query) {
                $query->where('name', 'like', '%'.$this->location.'%');
            });
        })
        ->get();

        return $users;

    }

    public function findUser(Request $request)
    {
        $user = User::where('id',$request['id'])->with('locations', 'group', 'services')->first();
        return $user;
    }


}
