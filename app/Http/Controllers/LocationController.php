<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Ip;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function list()
    {
        $locations = Location::with('ips')->get();
        return $locations;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:locations,name',
            'location_type_id' => 'integer|required',
            'description' => 'string|nullable',
            'address' => 'string|nullable',
            'city' => 'string|nullable',
            'phone1' => 'integer|nullable',
            'phone2' => 'integer|nullable',
        ]);


        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $location = Location::create($validation->validated());
            if ($request->ips) {
                $location->ips()->saveMany([$request->ips]);
            }
            return $location;
        }
    }

    public function edit(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:locations,name,'.$location->id,
            'location_type_id' => 'integer|required',
            'description' => 'string|nullable',
            'address' => 'string|nullable',
            'city' => 'string|nullable',
            'phone1' => 'integer|nullable',
            'phone2' => 'integer|nullable',
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $ar = [];
            $location->update($validation->validated());
            $location->ips()->delete();
            if($request->ips){
                foreach ($request->ips as $value) {
                    Ip::create([
                        "location_id" => $location->id,
                        "ip" => $value['ip']
                    ]);
                }
            }
            return $location;
        }
    }

    public function delete(Location $location)
    {
        $location->ips()->delete();
        $location->delete();
        return "success";
    }
}
