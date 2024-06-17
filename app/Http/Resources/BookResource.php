<?php

namespace App\Http\Resources;

use App\Models\Store\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->resource->id,
            "name" => $this->resource->name,
            'user_id' =>  $this->resource->user_id,
            'store' => StoreResource::make($this->whenLoaded('store')),
            'barcode' => $this->resource->barcode,
            'pages_number' => $this->resource->pages_number,
            'published' => $this->resource->published,
            'store_custom' => $this->when(
                $this->resource->relationLoaded('store'),
                function () {
                    return $this->resource->store ? [
                    'id' => $this->resource->store->id,
                    'name' => $this->resource->store->name
                    ] : null;
                }
            ),
            $this->merge(
                Arr::except(
                    parent::toArray($request),
                    [
                    'store_id', 'user_id'
                    ]
                )
            )
        ];
    }
}
