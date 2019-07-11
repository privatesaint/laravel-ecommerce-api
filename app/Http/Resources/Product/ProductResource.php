<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'name' => $this->name,
          'description' => $this->detail,
          'price' => $this->price,
          'stock' => $this->stock == 0 ? 'Out of Stock' : $this->stock,
          'discount' => $this->discount,
          'totalPrice' => round((1 - ($this->discount/100)) * $this->price, 2),
          'rating' => round($this->reviews->avg('star')) == 0 ? 'No rating yet' : round($this->reviews->avg('star')) ,
          'href' =>[
            'reviews' => route('reviews.index',$this->id)
          ]
        ];
    }
}
