<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'about' => $this->about,
            'address' => $this->address,
            'contact' => $this->contact,
            'image' => $this->imageUrl,
            'website' => $this->website,
            'rating' => $this->rating,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'ratings' => RatingResource::collection($this->whenLoaded('ratings')),
        ];
    }
}
