<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThemeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Theme extends Controller
{
    public function index(){
        $theme = \App\Models\Theme::all();
        return ThemeResource::collection($theme->all());
    }
    public function store(Request $request){
        $theme = new \App\Models\Theme();
        $theme->category_id = $request->category_id;
        $theme->code = $request->code;
        $theme->name = $request->name;
        $theme->type = $request->type;
        $theme->gender = $request->gender;
//        $d->current_qty = $request->current_qty;
//        $dress->borrow_price = $request->borrow_price;
//        $dress->selling_price = $request->selling_price;
//        $dress->supplier = $request->supplier;
        $theme->description = ucfirst($request->description);
        if ($request->file('main_photo')){
            $newName =uniqid().$request->file('main_photo')->getClientOriginalName();
            $request->file('main_photo')->storeAs('public/theme/main_photo',$newName);
            $theme->main_photo = $newName;
        }

//         if ($request->file('related_photo')){
// //            return $request->file('related_photo');
//             $newName =uniqid().$request->file('related_photo')->getClientOriginalName();
//             $request->file('related_photo')->storeAs('public/theme/related_photo',$newName);
//             $theme->related_photo = $newName;
//         }

        $imgs =$request->file('related_photo');



        foreach ($imgs as  $key=>$img) {
            $newName = uniqid() . $img->getClientOriginalName();
            $img->storeAs('public/theme/related_photo', $newName);
            // Add the file name to the array
            $many[] = $newName;
        }

        // Convert the array to a JSON string
        $jsonRelatedPhotos = json_encode($many);

        // Assign the JSON string to the 'related_photo' attribute
        $theme->related_photos = $jsonRelatedPhotos;


        $theme->save();
        return response()->json([
            'error'=>false,
            "message"=>'Dress created is successfully',
            "data"=>$theme,

        ]);
    }
    public function destroy($id){
        $theme = \App\Models\Theme::find($id);
        $theme->delete();
        return response()->json([
            'sucess'=>'deleted is successfully'
        ]);
    }
    public function update(Request $request,$id){
        {

            $theme = \App\Models\Theme::find($id);
            $theme->category_id = $request->category_id;
            $theme->code = $request->code;
            $theme->name = $request->name;
            $theme->type = $request->type;
            $theme->gender = $request->gender;
            $theme->description = ucfirst($request->description);
            if ($request->file('main_photo')){
                $newName =uniqid().$request->file('main_photo')->getClientOriginalName();
                $request->file('main_photo')->storeAs('public/theme/main_photo',$newName);
                $theme->main_photo = $newName;
            }

            $imgs =$request->file('related_photo');


            foreach ($imgs as  $key=>$img) {
                $newName = uniqid() . $img->getClientOriginalName();
                $url = $img->storeAs('public/theme/related_photo', $newName);
                // Add the file name to the array
                $many[] = $newName;
            }

            // Convert the array to a JSON string
            $jsonRelatedPhotos = json_encode($many);
            $url = Storage::url('public/theme/related_photo/'.$newName);
//
//

            $theme->update();
            return response()->json([
                'error'=>false,
                "message"=>'Theme created is successfully',
                "data"=>$theme,
            ]);

        }
    }
}
