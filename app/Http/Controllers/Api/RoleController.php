<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //index
    public function index()
    {
        $roles = Role::all();
        return response([
            'message' => 'Roles list',
            'data' => $roles
        ], 200);
    }

    //store
    public function store(Request $request){

        //validate request
        $request->validate([
            'name' => 'required',
        ]);

        $role = new Role();
        $role->company_id = 1;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description =$request->description;
        $role->save();

        return response([
            'message' => 'Role Created',
            'data' => $role
        ], 201);

    }

    //show

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role){
            return response([
                'message' => 'Role Not Found',
            ],404);
        }
        return response([
            'message' => 'Role Detail',
            'data' => $role
        ],200);
    }

    //update
    public function update(Request $request){

        //validate request
        //list permission
        $request->validate([
            'name' => 'required',
            'permissionIds' => 'required|array',
        ]);

        $role =ROle::find($id);
        if (!$role){
            return response([
                'message' => 'Role Not Found',
            ],404);
        }

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description =$request->description;
        $role->save();

        $role->permission()->sync($request->permissionIds);

        return response([
            'message' => 'Role update',
            'data' => $role
        ], 201);

    }




}
