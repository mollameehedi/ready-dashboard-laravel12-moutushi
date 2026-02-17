<?php

namespace App\Services;

use App\Models\Product\Product;

class PriceCalculationService
{
    /**
     * Calculates the final price of a product, applying a flash sale price if applicable.
     *
     * @param Product $product The product model instance.
     * @return float The final calculated price.
     */
    public function calculatePrice(Product $product): float
    {
        $price = $product->price;

        if ($product->flashProduct &&
            $product->flashProduct->flashSale?->is_current == true &&
            $product->flashProduct->quantity > $product->flashProduct->sold_quantity
        ) {
            // If all conditions are met, use the flash sale price.
            $price = $product->flashProduct->price;
        }

        // Return the final price.
        return $price;
    }
}
