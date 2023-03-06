<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->status,
            'pray' => $this->pray,
            'pray_count' => $this->pray_count,
            'translated_at' => $this->translated_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}