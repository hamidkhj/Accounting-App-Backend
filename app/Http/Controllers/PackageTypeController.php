<?php

namespace App\Http\Controllers;

use App\Models\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class PackageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packageTypes = PackageType::all();
        return $packageTypes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:package_types,name|string',
            'description' => 'string|nullable', 
            'priority' => 'required|integer'
        ]);

        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        }else {
            $pt = PackageType::create($validation->validated());
            return $pt;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function show(PackageType $packageType)
    {
        return $packageType;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageType $packageType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageType $packageType)
    {
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:package_types,name,'.$packageType->id,
            'description' => 'string|nullable', 
            'priority' => 'required|integer'
        ]);

        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        }else {
            $packageType->update($validation->validated());
            return $packageType;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageType $packageType)
    {
        $packageType->packages()->update(['package_type_id' => '1']);
        $packageType->delete();
    }
}
