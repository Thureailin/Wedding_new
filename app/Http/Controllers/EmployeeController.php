<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employee = Employee::all();
        return EmployeeResource::collection($employee->all());
    }
    public function store(Request $request){
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->role = $request->role;
        $employee->save();
        return response()->json([
            'error'=>false,
            "message"=>'Category created is successfully',
            "data"=>$employee
        ]);
    }
    public function destroy($id){
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json([
            'data'=>'Category Deleted Successfully!',
        ]);
    }
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string',
            'address'=>'required|string',
            'role'=>'required|string',
            // Add other validation rules here
        ]);
        $employee = Employee::find($id);
        $employee->update($validatedData);
        return response()->json([
            'data'=>'Status Updated Successfully!',
        ]);
    }
}
