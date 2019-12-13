<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Products\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => (int) $product->id, 
            'name' => (string) $product->name,
            'img' => (string) $product->img, 
            'value' => (string)'$'.number_format($product->value, 0, ',', '.'),
            'type' => (array) $product->type, 
            'available' => (int) $product->available, 
        ];
    }
}
