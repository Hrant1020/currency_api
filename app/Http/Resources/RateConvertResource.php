<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateConvertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "currency_from" => $this->resource->currency_from,
            "currency_to" => $this->resource->currency_to,
            "value" => $this->resource->value,
            "converted_value" => $this->resource->converted_value,
            "rate" => $this->resource->rate,
            "created_at" => $this->resource->created_at
        ];
    }
}
