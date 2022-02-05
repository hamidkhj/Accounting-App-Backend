<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::with("groups")->with('locations')->get();
        return $packages;
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
        // return ($request->locations);

        $validation = Validator::make($request->all(), [
            'package_type_id' => 'required|integer',
            'name' => 'string|required',
            'description' => 'string|required',
            'duration' => 'required|integer',
            'size' => 'required|integer',
            'price' => 'required|integer',
            'price' => 'required|integer',
            'is_for_sale' => 'required|boolean',
        ]);

        if($validation->fails()){
            return response()->json($validation->messages());
        }else{
            $package = Package::create($validation->validated());
            $package->locations()->sync($request->locations);
            $package->groups()->sync($request->groups);

            return $package;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return $package;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $validation = Validator::make($request->all(), [
            'package_type_id' => 'required|integer',
            'name' => 'string|required',
            'description' => 'string|required',
            'duration' => 'required|integer',
            'size' => 'required|integer',
            'price' => 'required|integer',
            'price' => 'required|integer',
            'is_for_sale' => 'required|boolean',
        ]);

        if($validation->fails()){
            return response()->json($validation->messages());
        }else{
            // return $request->locations;
            $package->update($validation->validated());
            $package->locations()->sync($request->locations);
            $package->groups()->sync($request->groups);
            return $package;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
