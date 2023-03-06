<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyResource extends JsonResource
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
            'pray_id' => $this->pray_id,
            'pray' => new PrayResource($this->pray),
            'status' => $this->status,
            'date' => $this->date,
            'translated_at' => $this->translated_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
