<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class ServiceController extends Controller
{
    public function list()
    {
        $services = Service::orderByDesc("updated_at")->get();
        return $services;
    }

    public function store(Request $request)
    {
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:services,name',
            'search_name' => 'string|required',
            'description' => 'string|nullable',
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
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
        App::setlocale('fa');
        $validation = Validator::make($request->all(), [
            'name' => 'string|required|unique:services,name,'.$service->id,
            'search_name' => 'string|required',
            'description' => 'string|nullable',
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
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
