<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
//        $package = Package::all();
        return PackageResource::collection(Package::all());
    }
    public function store(Request $request){
        $package = new Package();
        $package->code = $request->code;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->dress_id = $request->dress_id;
        $package->no_of_dress = $request->no_of_dress;
        $package->theme_id = $request->theme_id;
        $package->no_of_theme = $request->no_of_theme;
        $package->no_of_retouched_photo = $request->no_of_retouched_photo;
        $package->no_of_soft_copy_photo = $request->no_of_soft_copy_photo;
        $package->no_of_hard_copy = $request->no_of_hard_copy;
        $package->frame_flag = $request->frame_flag;
        $package->no_of_frame = $request->no_of_frame;
        $package->frame_specification = $request->frame_specification;
        $package->album_flag =$request->album_flag;
        $package->no_of_album =$request-> no_of_album;
        $package->album_specification =$request-> album_specification;
//        $package->main_frame_size = $request->main_frame_size;
        $package->description = $request->description;
//        $package->employee_id = $request->employee_id;
        $package->save();
        return response()->json([
            'error'=>false,
            "message"=>'Package is created successfully',
            "data"=>$package
        ]);
    }
    public function destroy($id){
        $package = Package::find($id);
        $package->delete();
        return response()->json([
            'success'=>'Is Deleted successfully'
        ]);
    }
    public function update(Request $request,$id){
        $package = Package::find($id);
        $package->code = $request->code;
        $package->name = $request->name;
        $package->price = $request->price;
        $package->dress_id = $request->dress_id;
        $package->no_of_dress = $request->no_of_dress;
        $package->theme_id = $request->theme_id;
        $package->no_of_theme = $request->no_of_theme;
        $package->no_of_retouched_photo = $request->no_of_retouched_photo;
        $package->no_of_soft_copy_photo = $request->no_of_soft_copy_photo;
        $package->no_of_hard_copy = $request->no_of_hard_copy;
        $package->frame_flag = $request->frame_flag;
        $package->no_of_frame = $request->no_of_frame;
        $package->frame_specification = $request->frame_specification;
        $package->album_flag =$request->album_flag;
        $package->no_of_album =$request-> no_of_album;
        $package->album_specification =$request-> album_specification;
//        $package->main_frame_size = $request->main_frame_size;
        $package->description = $request->description;
//        $package->employee_id = $request->employee_id;
        $package->update();
        return response()->json([
            'error'=>false,
            "message"=>'Package updated is successfully',
            "data"=>$package
        ]);
    }

}
