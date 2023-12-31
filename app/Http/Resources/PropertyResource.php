<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\OptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'title' => $this->title,
             $this->mergeWhen(true, [
                'price' => $this->price,
                'surface' => $this->surface,
             ]),
            'options' => OptionResource::collection($this->whenLoaded('options'))
        ];
    }
}
