<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category" => Category::where('id',$this->category_id)->first()->name,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "photo" => $this->photo,
        ];
    }
}
