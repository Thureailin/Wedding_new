<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'code'=> $this->code,
            'name'=> $this->name,
            'price'=> $this->price,
            'dress_id'=> $this->dress_id,
            'theme_id'=> $this->theme_id,
            'no_of_dress'=> $this->no_of_dress,
            'no_of_theme'=> $this->no_of_theme,
            'no_of_retouched_photo'=> $this->no_of_retouched_photo,
            'no_of_soft_copy_photo'=> $this->no_of_soft_copy_photo,
            'no_of_hard_copy'=>$this->no_of_hard_copy,
            'frame_flag '=>$this->frame_flag,
            'no_of_frame'=> $this->no_of_frame,
            'frame_specification' => $this->frame_specification,
            ' album_flag'=> $this->album_flag,
            'no_of_album' => $this-> no_of_album,
            'album_specification' => $this->album_specification,
            'description'=> $this->description,

        ];
    }
}
