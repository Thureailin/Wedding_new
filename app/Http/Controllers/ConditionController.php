<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConditionResource;
use App\Models\Booking;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index(){

      $condition = Condition::all();
       return ConditionResource::collection($condition->all());


    }
    public function store(Request $request){

        $condition = new Condition();
        $condition->id = $request->id;
        $condition->date = $request->date;
        $condition->time = $request->time;
        $condition->count = $request->count;
        $condition->status = $request->status;
        $condition->save();
        return response()->json([
            'error'=>false,
            "message"=>'Status created is successfully',
            "data"=>$condition
        ]);
    }
    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'date' => 'required|string',
            'status' => 'required|string',
            'time'=>'required|string',
            'count'=>'required'
            // Add other validation rules here
        ]);
        $condition = Condition::find($id);
        $condition->update($validatedData);

        return response()->json([
            'data'=>'Condition Updated Successfully!',
        ]);
    }
    public function destroy($id){
        $condition = Condition::find($id);
        $condition->delete();
        return response()->json([
            'data'=>'Status Deleted Successfully!',
        ]);
    }

}
