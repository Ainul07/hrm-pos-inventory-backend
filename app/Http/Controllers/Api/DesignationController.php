<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;


class DesignationController extends Controller
{
    //index

    public function index()
    {
        $designation =Designation::all();
        return response([
            'message' => 'Designation list',
            'data' => $designations
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        //vr

        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $designation = new Designation();
        $designation->company_id = 1;
        $designation->created_by = $user->id;
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();

        return response([
            'message' => 'Designation created',
            'data' => $designation
        ],201);
    }

    //SHOW

    public function show($id)
    {
        $designation = Designation::find($id);
        if(!$designation){
            return response([
                'message' => 'Designation Not Found'

            ], 404);
        }

        return response([
            'message' => ' Designation Details',
            'data' => $designation
        ], 200);

    }

    //update

    public function update(Request $request, $id)
    {
        //vr
        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user->id();

        $designation =Designation::find($id);
        if(!$designation){
            return response([
                'message' => 'Designation not found'
            ], 404);
        }
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();

        return response([
            'message' => 'Designation updated',
            'data' => $designation
        ], 200);
    }

    //destroy

    public function destroy($id)
    {
        $designation = Designation::find($id);
        if(!$designation){
            return response([
                'message' => 'Designation Not Found'
            ], 404);

        }
        $designation->delete();

        return response([
            'message' => 'Designation deleted',
            'data' => $designation
        ], 200);
    }



}
