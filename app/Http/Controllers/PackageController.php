<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

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
        App::setlocale('fa');

        $validation = Validator::make($request->all(), [
            'package_type_id' => 'required|integer',
            'name' => 'string|required',
            'description' => 'string|nullable',
            'duration' => 'required|integer',
            'size' => 'required|integer',
            'price' => 'required|integer',
            'price' => 'required|integer',
            'is_for_sale' => 'required|boolean',
        ]);

        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
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
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'package_type_id' => 'required|integer',
            'name' => 'string|required',
            'description' => 'string|nullable',
            'duration' => 'required|integer',
            'size' => 'required|integer',
            'price' => 'required|integer',
            'price' => 'required|integer',
            'is_for_sale' => 'required|boolean',
        ]);

        if($validation->fails()){
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
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


        /**
     * Retrive packages for sales page.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function packagesForSale()
    {

        $packages = Package::whereHas('groups', function ($query){
            $query->where('groups.id', Auth()->user()->group_id);
        })->where('is_for_sale', 1)
        ->where('package_type_id', '!=', 1)
        ->get();

        return $packages;
    }
}
