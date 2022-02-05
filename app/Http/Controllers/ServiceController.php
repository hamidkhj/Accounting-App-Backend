<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function list()
    {
        $services = Service::all();
        return $services;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|required',
        ]);
        // return $validation->validated();

        if ($validation->fails()) {
            return response()->json($validation->messages());
        } else {
            $service = Service::create($validation->validated());
            return $service;
        }
    }

    public function edit(Service $service)
    {
        return $service;
    }

    public function update(Request $request, Service $service)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages());
        } else {
            $service->update($validation->validated());
            return $service;
        }
    }

    public function delete(Service $service)
    {
        $service->delete();
        return 'success';
    }
}
