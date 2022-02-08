<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function list()
    {
        $groups = Group::all();
        return $groups;
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|nullable',
            'package_id' => 'integer|required',
            'hour_limit' => 'integer|required',
        ]);
        // return $validation->validated();

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $group = Group::create($validation->validated());
            return $group;
        }
    }

    public function edit(Group $group)
    {
        return $group;
    }

    public function update(Request $request, Group $group)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'string|nullable',
            'package_id' => 'integer|required',
            'hour_limit' => 'integer|required',
        ]);

        if ($validation->fails()) {
            $response = ['message' => $validation->messages(), 'code' => 400];
            return response()->json($response);
        } else {
            $group->update($validation->validated());
            return $group;
        }
    }

    public function delete(Group $group)
    {
        // $group->users()->update(['group_id' => 1]);
        $group->delete();
        return 'success';
    }

}
