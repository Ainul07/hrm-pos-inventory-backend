<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    //indx

   public function index(){

        $shifts = Shift::all();
        return response([
            'message' => 'Shift List',
            'data' => $shifts
        ], 200);
   }

   //store

   public function store(Request $request)
   {
    //vr
    $request->validate([
        'name' => 'required',
        'clock_in_time' =>'required',
        'clock_out_time' => 'required'
    ]);

    $user = $request->user->id();

    $shift = new Shift();
    $shift->company_id = 1;
    $shift->created_by = $request->user->id;
    $shift->name = $request->name;
    $shift->clock_in_time = $request->clock_in_time;
    $shift->clock_out_time =$request->clock_out_time;
    $shift->late_mark_after =$request->late_mark_aftert;
    $shift->early_clock_in_time = $request->early_clock_in_time;
    $hift->allow_clock_out_till = $reuest->allow_clock_out_till;
    $shift->save();

    return response([
        'message' => 'shift created',
        'data' => $shift
    ], 201);

   }

   //show

   public function show($id)
   {
    $shift = Shift::find($id);
    if(!$shift){
        return response([
            'message' => 'Shift Not Found'
        ], 404);
    }
    return response([
        'message' => 'Details Shift',
        'data' => $shift
    ], 200);
   }

   //updt
   public function update(Request $request, $id)
   {
    //vr
    $request->validate([
        'name' => 'required',
        'clock_in_time' => 'required',
        'clock_out_time' => 'required',
    ]);

    $shift = Shift::find($id);
    if(!$shift){
        return response([
            'message' => 'Shift Not Found'
        ], 404);
    }

    $shift->name = $request->name;
    $shift->clock_in_time = $request->clock_in_time;
    $shift->clock_out_time = $request->clock_out_time;
    $shift->late_mark_after = $request->late_mark_after;
    $shift->early_clock_in_time = $request->early_clock_in_time;
    $shift->allow_clock_in_time = $request->allow_clock_in_time;
    $shift->save();

    return response([
        'message' => 'Shift Updated',
        'data' => $shift
    ],200);

   }

   //destroy

   public function destroy($id)
   {
    $shift = Shift::find($id);
    if(!shift){
        return response([
            'message' => 'Shift Not Found'
        ], 404);
    }
    $shift->delete();
    return response([
        'message' => 'Shift deeleted',
        'data' => $shift
    ], 200);
   }


}
