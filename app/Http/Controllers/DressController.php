<?php

namespace App\Http\Controllers;

use App\Http\Resources\DressResource;
use App\Models\Dress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DressController extends Controller
{
    public function index(){
        $dress = Dress::all();

        return DressResource::collection($dress->all());
    }
    public function store(Request $request){
        $dress = new Dress();
        $dress->category_id = $request->category_id;
        $dress->code = $request->code;
        $dress->name = $request->name;
        $dress->type = $request->type;
        $dress->gender = $request->gender;
        $dress->current_qty = $request->current_qty;
        $dress->borrow_price = $request->borrow_price;
        $dress->selling_price = $request->selling_price;
//        $dress->supplier = $request->supplier;
        $dress->description = ucfirst($request->description);
        if ($request->file('main_photo')){
            $newName =uniqid().$request->file('main_photo')->getClientOriginalName();
            $request->file('main_photo')->storeAs('public/dress/main_photo',$newName);
            $dress->main_photo = $newName;
        }

        $imgs =$request->file('related_photo');


        foreach ($imgs as  $key=>$img) {
            $newName = uniqid() . $img->getClientOriginalName();
            $url = $img->storeAs('public/dress/related_photo', $newName);
            // Add the file name to the array
            $many[] = $newName;
        }

        // Convert the array to a JSON string
        $jsonRelatedPhotos = json_encode($many);
//        $url = Storage::url('public/dress/related_photo/'.$newName);


        // Assign the JSON string to the 'related_photo' attribute
        $dress->related_photos = $jsonRelatedPhotos;


        $dress->save();
        return response()->json([
            'error'=>false,
            "message"=>'Dress created is successfully',
            "data"=>$dress,



        ]);
    }
    public function destroy($id){
        $dress = Dress::find($id);
        if(!is_null($dress->main_photo)){
            $oldPhoto = asset('storage/main_photo/'.$dress->main_photo);
            Storage::delete($oldPhoto);
        }
        if(!is_null($dress->related_photo)){
            $oldPhoto = asset('storage/related_photo/'.$dress->related_photo);
            Storage::delete($oldPhoto);
        }
        $dress->delete();
        return response()->json([
            'data'=>'Success'
        ]);
    }
    public function update(Request $request, $id)
    {

        $dress = Dress::find($id);
        $dress->category_id = $request->category_id;
        $dress->code = $request->code;
        $dress->name = $request->name;
        $dress->type = $request->type;
        $dress->gender = $request->gender;
        $dress->current_qty = $request->current_qty;
        $dress->borrow_price = $request->borrow_price;
        $dress->selling_price = $request->selling_price;
        $dress->description = ucfirst($request->description);
        if ($request->file('main_photo')){
            $newName =uniqid().$request->file('main_photo')->getClientOriginalName();
            $request->file('main_photo')->storeAs('public/dress/main_photo',$newName);
            $dress->main_photo = $newName;
        }

        $imgs =$request->file('related_photo');


        foreach ($imgs as  $key=>$img) {
            $newName = uniqid() . $img->getClientOriginalName();
            $url = $img->storeAs('public/dress/related_photo', $newName);
            // Add the file name to the array
            $many[] = $newName;
        }

        // Convert the array to a JSON string
        $jsonRelatedPhotos = json_encode($many);
        $url = Storage::url('public/dress/related_photo/'.$newName);
//
//

        $dress->update();
           return response()->json([
               'error'=>false,
               "message"=>'Dress created is successfully',
               "data"=>$dress,
           ]);

    }
}
