<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\Service;
use App\Models\ConnectionLog;
use App\Models\ActionLog;
use App\Models\CallsLog;
use App\Models\ParsianRecord;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ipReport(Request $request)
    {
        $users = [];
        if ($request['groupId'] != '') {
            $id = $request['groupId'];
            $users = User::where('group_id', $id)->where('static_ip', '!=', null)->get();
        } else if ($request['user_name'] != '') {
            $userName = $request['user_name'];
            $users = User::where('user_name', 'like' , '%'.$userName.'%')->get();
        } else if ($request['firstName'] != '' && $request['lastName'] != '') {
            $firstName = $request['firstName'];
            $lastName = $request['lastName'];
            $users = User::where('first_name', 'like' , '%'.$firstName.'%')->orWhere('last_name', 'like' , '%'.$lastName.'%')->get();
        } else if ($request['firstName'] != '') {
            $firstName = $request['firstName'];
            $users = User::where('first_name', 'like' , '%'.$firstName.'%')->get();           
        } else if ($request['lastName'] != '') {
            $lastName = $request['lastName'];
            $users = User::where('last_name', 'like' , '%'.$lastName.'%')->get();           
        } else if ($request['ip'] != '') {
            $ip = $request['ip'];
            $users = User::where('static_ip', $ip)->get();   
        } else {
            $users = User::where('static_ip', '!=', null)->get();
        }

        return $users;
    }

    public function packageReport(Request $request)
    {
        $packages = [];
        $end = $date = date ("Y/m/d H:i", (strtotime($request['endDate']) + 24*60*60 - 1)). ":00";
        $start = $request['startDate'];


        if ($request['groupId']) {
            $id = $request['groupId'];
            $list = User::select('id')->where('group_id', $id)->get();

            if ($request['duration']){
                if ($request['sizes'] != []) {
                    $packages = UserPackage::whereIn('user_id', $list)->where('duration', $request['duration'])->whereIn('size', $request['sizes'])->whereBetween('purchase_date', [$start, $end])->get();
                } else {
                    $packages = UserPackage::whereIn('user_id', $list)->where('duration', $request['duration'])->whereBetween('purchase_date', [$start, $end])->get();
                }
            } else {
                $packages = UserPackage::whereIn('user_id', $list)->whereBetween('purchase_date', [$start, $end])->get();
            }
        } else if ($request['userName'] != '') {
            if ($request['duration']){
                if ($request['sizes'] != []) {
                    $packages = User::where('user_name', $request['userName'])->first()->userPackages()->where('duration', $request['duration'])->whereIn('size', $request['sizes'])->whereBetween('purchase_date', [$start, $end])->get();
                } else {
                    $packages = User::where('user_name', $request['userName'])->first()->userPackages()->where('duration', $request['duration'])->whereBetween('purchase_date', [$start, $end])->get();
                } 
            }else {
                $packages = User::where('user_name', $request['userName'])->first()->userPackages()->whereBetween('purchase_date', [$start, $end])->get();
            }
        } else if ($request['duration']){
            if ($request['sizes'] != []) {
                $packages = UserPackage::where('duration', $request['duration'])->whereIn('size', $request['sizes'])->whereBetween('purchase_date', [$start, $end])->get();
            } else {
                $packages = UserPackage::where('duration', $request['duration'])->whereBetween('purchase_date', [$start, $end])->get();
            }
        } else {
            $packages = UserPackage::whereBetween('purchase_date', [$start, $end])->get();
        }

        return $packages;
    }

    public function userConsumptionReport(Request $request)
    {
        $report = [];
        $end = $date = date ("Y/m/d H:i", (strtotime($request['endDate']) + 24*60*60 - 1)). ":00";
        $start = $request['startDate'];
        $this->services = [];
        $this->services = Service::whereIn('id', $request['services'])->get()->pluck('search_name');


        try {
            $report = ConnectionLog::where('user_id', $request['id'])->whereBetween('log_date', [$start, $end])->when(count($this->services) > 0 , function ($query) {
                $query->where( function ($query) {
                    foreach ($this->services as $item) {
                        $query -> orWhere('line', 'like', '%'.$item.'%');
                    }
                });
            })
            ->get();
            // ->toSql();
        } catch (\Throwable $th) {
            return $th;
        }
        

        return $report;
    }

    public function userActionLogReport(Request $request)
    {
        $report = [];
        $end = $date = date ("Y/m/d H:i", (strtotime($request['endDate']) + 24*60*60 - 1)). ":00";
        $start = $request['startDate'];

        try {
            $report = ActionLog::with('creator:id,user_name', 'target:id,user_name')->where('user_id', $request['id'])->whereBetween('created_at', [$start, $end])->get();
        } catch (\Throwable $th) {
            return $th;
        }
        

        return $report;
    }

    public function userErrorReport(Request $request)
    {
        $report = [];
        $end = $date = date ("Y/m/d H:i", (strtotime($request['endDate']) + 24*60*60 - 1)). ":00";
        $start = $request['startDate'];

        // $return (['start'=> $start, 'end'=> $end]);

        try {
            $report = CallsLog::with('user:id,user_name')->where('user_id', $request['id'])->whereBetween('log_date', [$start, $end])->get();
        } catch (\Throwable $th) {
            return $th;
        }
        

        return $report;
    }

    public function bankReport(Request $request)
    {
        $report = [];
        $end = $date = date ("Y/m/d H:i", (strtotime($request['endDate']) + 24*60*60 - 1)). ":00";
        $start = $request['startDate'];
        $amount = 0;
        $user = null;
        $this->userID = 0;

        // return $request->all();
        if ($request->userName) {
            $user = User::where('user_name' , $request->userName)->first();
            if ($user == null){
                return $report;
            }

            $this->userID = $user->id;
        }

        if ($request->amount) {
            $amount = $request->amount;
        }

        $report = ParsianRecord::with('user:id,user_name')
        ->when($request->userName, function ($query) {
            $query->where('user_id', $this->userID);
        })
        ->when($request->paymentStatus == 'success', function ($query, $amount) {
            $query->where('status', 'SUCCESS');
        })
        ->when($request->amount, function ($query,$amount) {
            $query->where('price', $amount);
        })
        ->whereBetween('created_at', [$start, $end])->get();

        return $report;
    }
}
