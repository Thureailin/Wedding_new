<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();

        return CategoryResource::collection($category->all());
    }
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->type = $request->type;
        $category->save();
        return response()->json([
            'error'=>false,
            "message"=>'Category created is successfully',
            "data"=>$category
        ]);
    }
    public function destroy($id){
        $category = Category::find($id);

        $category->delete();
        return response()->json([
            'data'=>'Category Deleted Successfully!',
        ]);
    }
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules here
        ]);
        $category = Category::find($id);
        $category->update($validatedData);
        return response()->json([
            'data'=>'Category Updated Successfully!',
        ]);
    }
}
