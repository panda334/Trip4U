<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\DayPlansResource;
use App\Http\Resources\FeaturesResource;
use App\Http\Resources\AdvantageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'start_date' => $this->first_date,
                'end_date' => $this->end_date,
                'duration' => $this->duration,
                'adult_price' => $this->adult_price,
                'children_price' => $this->children_price,
                'infant_price' => $this->infant_price,
                'type' => $this->type,
                'avibality' => $this->avibality,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ],

                'features' => FeaturesResource::collection($this->whenLoaded('features')),
                'day_plans' => DayPlansResource::collection($this->whenLoaded('day_plans')),
                'advantages' => AdvantageResource::collection($this->whenLoaded('advantages')),
                'destination' => new DestinationResource($this->whenLoaded('destination')) // Because its not a collection
            
        ];
    }
}
