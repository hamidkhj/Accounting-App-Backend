<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use App\Models\UserPackage;
use App\Models\ConnectionLog;
use App\Models\RecoverPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPassword;
use App\Mail\RecoverPasswordCode;



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
            'phone'=> 'regex:([0-9]*)|required',
            'personal_code'=> 'integer|required',
            'gender'=> 'string|required',
            'meli_code'=> 'regex:([0-9]*)|required',
            'static_ip'=> 'string|nullable|unique:users,static_ip,'.$request->id,
            'email'=> 'email|required',
            'org_email'=> 'email|nullable',
            'is_active'=> 'boolean|required',
            'major'=> 'string|nullable',
            'passport'=> 'regex:([0-9]*)|nullable',
            'mobile1'=> 'regex:([0-9]*)|required',
            'mobile2'=> 'regex:([0-9]*)|nullable',
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
        $user = User::where('id',$request['id'])->with('locations', 'group', 'services','role')->first();
        return $user;
    }

    public function getFreePackageInfo(Request $request)
    {
        $userID = auth()->id();
        $freePacakge = UserPackage::where('user_id', $userID)->where('purchase_date' , '>' , $request->date)->where('package_id', 0)->first();
        return $freePacakge;
    }

    public function getPurchasedPacakge(Request $request)
    {
        $userID = auth()->id();
        $purchasedPackage = UserPackage::where('user_id', $userID)
            ->where('package_id', '!=', 0)
            ->where('remaining_megabyte', '>', 0)
            ->where('expiration_date', '>', $request->date)
            ->orderBy('expiration_date')
            ->first();
        
        return $purchasedPackage;
    }

    public function getTodayUsage(Request $request)
    {
        $start = $request->date. ' 00:00:00';
        $end = $request->date. ' 23:59:59';
        // return $start;

        $bytes = ConnectionLog::select(DB::raw('SUM(bytes_in) as download, SUM(bytes_out) as upload, SUM(duration) as duration'))
        ->where('user_id', auth()->id())
        ->whereBetween('log_date', [$start, $end])
        ->get();

        return $bytes[0];
    }

    public function changeRole(Request $request)
    {
       
        $validation = Validator::make($request->all(), [
            'roleId' => 'required|integer',
            'userId' => 'required|integer',
        ]);

        if($validation->fails()) {
            return response()->json($validation->messages());
        } else {
            $uid = $validation->validated()['userId'];
            $rid = $validation->validated()['roleId'];
            $user = User::find($uid);
            if(!$user) {
                return response()->json('user not found');
            }
            $user->syncRoles([$rid]);
            return response()->json('success');
        }
        
    }

    public function ResetPasswordByAdmin(User $user)
    {
        $random = Str::random(10);
        $user->update(['password' => bcrypt($random)]);
        Mail::to($user->email)->send(new NewPassword($user, $random));
        return 'success';
    }

    public function forgotPassword(Request $request)
    {
        $this->validation = Validator::make($request->all(), [
            'username' => 'required',
            'phone' => 'required',
        ]);

        if($this->validation->fails()) {
            return response()->json([
                'errors' => $this->validation->messages()
            ]);
         } else {
            $user = User::where('user_name', $this->validation->validated()['username'])
            ->where(function($query){
                $query->where('mobile1', $this->validation->validated()['phone'])
                ->orWhere('mobile2', $this->validation->validated()['phone']);
            })->first();
            
            if(!$user){
                return response()->json([
                    'errors' => ['کاربر با مشخصات وارد شده وجود ندارد']
                ]);
            }

            $oldCode = RecoverPassword::where('recover_code' , '!=' , 0 )->get();

            if(!$oldCode->isEmpty()) {
                foreach ($oldCode as $item ) {
                    $item->update(['recover_code' => 0]);
                }
            }

            $code = random_int(100000, 999999);
            RecoverPassword::create([
                'user_id' => $user->id,
                "recover_code" => $code
            ]);
            Mail::to($user->email)->send(new RecoverPasswordCode($code));
            return 'success';
         }
    }

    public function requestNewPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'username' => 'required|string',
            'code' => 'required|string',
        ]);

        if($validation->fails()) {
            return response()->json($validation->messages());
        } else {
            $user = User::where('user_name', $validation->validated()['username'])->first();
            if(!$user){
                return 'invalid';
            }

            $code = RecoverPassword::where('user_id', $user->id)->where('recover_code', $validation->validated()['code'])->first();

            if(!$code){
                return 'invalid';
            }

            $random = Str::random(10);
            $user->update(['password' => bcrypt($random)]);
            Mail::to($user->email)->send(new NewPassword($user, $random));
            return 'success';

        }
    }


    // report functions 
    public function consumptionReport()
    {
        $report = [];

        try {
            $report = ConnectionLog::where('user_id', Auth()->id())->where('line', 'like', '%VPN%')
            ->orderByDesc('log_date')
            ->get();
            $report->makeHidden(['id', 'user_id']);
        } catch (\Throwable $th) {
            return $th;
        }
        

        return $report;
    }

    
    public function packageReport()
    {
        $report = [];

        try {
            $report = UserPackage::where('user_id', Auth()->id())->where('payment_type' ,'!=', 'free')
            ->orderByDesc('purchase_date')
            ->get();
            $report->makeHidden(['id', 'user_id']);
        } catch (\Throwable $th) {
            return $th;
        }
        

        return $report;
    }
}
