<?php

namespace App\Http\Resources;
use App\Http\Resources\ThematicResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ThematicCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $paginator= $this->resource;
        return [
            'data' => ThematicResource::collection($paginator),
            'per_page' => $paginator->perPage(),
            'total_page' => $paginator->lastPage(),
            'current_page' => $paginator->currentPage(),
            'total' => $paginator->total(),
        ];
    }
}
