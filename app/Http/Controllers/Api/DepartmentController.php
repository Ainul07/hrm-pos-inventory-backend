<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //index

    public function index()
    {
        $departments = Department::all;
        return response([
            'message' => 'Departments List',
            'data' => $departments
        ],200);
    }

    //store

    public function store(Request $request)
    {
        //validate req

        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $department = new Departmen();
        $department->company_id = 1;
        $department->created_by = $user->id;
        $department->name = $request->name;
        $department->descrtion = $request->description;
        $department->save();

        return response ([
            'message' => 'Departmen created',
            'data' => $department
        ], 201);


    }

    //show
    public function show($id)
    {
        $department =Department::find($id);
        if (!$department){
            return response([
                'message' => 'Departmen Not Fount',

            ], 404);
        }

        return response([
            'message' => 'Department Details',
            'data' => $department
        ],200);
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $department =Department::find($id);
        if(!$department){
            return response([
                'message' => 'Department Not Found',

            ], 404);
        }

        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return response([
            'message' => 'Department updated',
            'data' => $department
        ],200);
    }

    //destroy

    public function destroy($id)
    {
        $department = Department::find($id);
        if(!$department){
            return response([
                'message' => 'Department Not Found'
            ], 404);
        }

        $department->delete();
        return response([
            'message' => 'Department deleted'
        ], 200);
    }
}
