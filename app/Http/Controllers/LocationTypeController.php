<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationType;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class LocationTypeController extends Controller
{
    public function list()
    {
        $locationTypes = LocationType::all();
        return $locationTypes;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:location_types,name',
            'description' => 'string|nullable'
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $locationType = LocationType::create($validation->validated());
            return $locationType;
        }
    }

    public function edit(Location $location)
    {
        return $location;
    }

    public function update(Request $request, LocationType $locationType)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:location_types,name,'.$locationType->id,
            'description' => 'string|nullable'
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $locationType->update($validation->validated());
            return $locationType;
        }
    }

    public function delete(LocationType $locationType)
    {
        $locationType->locations()->update(['location_type_id'=> 1]);
        $locationType->delete();
    }
}
