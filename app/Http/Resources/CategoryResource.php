<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'image' => URL::signedRoute('product_title_photo.image',['product_title_photo' => $this->id]),
            'name'=> $this->name,
            'description'=> $this->description,
        ];
    }
}
