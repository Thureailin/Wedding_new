<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ThemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        {
            $category = Category::find($this->category_id);

            if(is_null($this->main_photo)){
                $main_photo = null;
            }else{
                $main_photo = asset('storage/theme/main_photo/'.$this->main_photo);
            }
//        if (is_null($this->related_photo)) {
//            $related_photo = null;
//        } elseif (is_string($this->related_photo)) {
//            $related_photo = asset('storage/theme/related_photo/' .$this->related_photo);
//        } else {
//            $related_photo = null; // Handle the case where $this->related_photo is not a valid string.
//        }
            $urls = [];
            $photos = json_decode($this->related_photos);
            foreach ($photos as  $photo){
                array_push($urls, asset(Storage::url('theme/related_photo/'.$photo)));
            }
            return [
                'id'=>$this->id,
                'code'=>$this->code,
                'name'=>$this->name,
                'type'=>$this->type,
                'category_id'=>$this->category_id,
                'description'=>$this->description,
                'main_photo'=>asset(Storage::url('theme/main_photo/'.$this->main_photo)),
                'related_photos'=>$urls,
                'gender'=>$this->gender,
            ];
        }
    }
}
