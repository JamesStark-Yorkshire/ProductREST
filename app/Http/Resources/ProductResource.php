<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $payload = [
            'product_id' => $this->getKey(),
            'product_name' => $this->product_name,
            'product_desc' => $this->product_desc,
            'product_category' => $this->product_category,
            'product_price' => $this->product_price,
        ];

        if ($this->relationLoaded('productDetails')) {
            $payload = array_merge($payload, $this->productDetails->pluck('value', 'key')->toArray());
        }

        return $payload;
    }
}
