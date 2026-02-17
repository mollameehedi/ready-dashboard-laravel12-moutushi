<?php

namespace App\Services;

use App\Models\Product\FlashSale;
use App\Models\Product\FlashSaleProduct;
use App\Models\Product\Product;
use Carbon\Carbon;

class FlashSaleService
{
    /**
     * Checks if a product is on an active flash sale and applies the discount.
     * Decrements the flash sale's sold quantity if applicable.
     *
     * @param Product $product The product model.
     * @param int $quantity The quantity being ordered.
     * @return float The final price for the product.
     * @return boolean The final price for the product.
     */
    public function getPriceAndDecrementStock(Product $product, int $quantity): float
    {
        $flashSaleProduct = $product->flashSaleProduct;
        if($flashSaleProduct && $flashSaleProduct->is_active &&
            $flashSaleProduct->flashSale &&
            $flashSaleProduct->flashSale->is_current == 1 &&
            Carbon::now()->between($flashSaleProduct->flashSale->start_date, $flashSaleProduct->flashSale->end_time) &&
            $flashSaleProduct->quantity >= ($flashSaleProduct->sold_quantity + $quantity)) {
            // The flash sale is active, apply the discounted price.
            $price = $flashSaleProduct->price;
            // Decrement the flash sale stock.
            $flashSaleProduct->increment('sold_quantity', $quantity);
            return $price;
        }
        // No active flash sale, return the regular product price.
        return $product->price;
    }
   public function isFlashAvailable(Product $product): bool
    {
        $flash = FlashSale::activeFlash();
        if(!$flash->exists()){
            return false;
        }
        return Product::where('id', $product->id)
            ->whereHas('flashSaleAcProducts', function ($q) use($flash) {
                $q->active()
                  ->whereColumn('quantity', '>', 'sold_quantity')->where('flash_sale_id',$flash->first()->id);
            })
            ->exists();
    }
   public function flashProduct(Product $product): ?FlashSaleProduct
{
    $flash = FlashSale::activeFlash()->first();

    if (!$flash) {
        return null;
    }

    $flash_product = FlashSaleProduct::where('product_id', $product->id)
        ->where('flash_sale_id', $flash->id)
        ->active()
        ->isQuantity()
        ->first(); // <-- Change `get()` to `first()`

    // This single line handles both found and not-found cases
    return $flash_product;
}

   public function calculatePrice(Product $product): ?int
{

    $price = $product->price;
     $flashProduct = $this->flashProduct($product);
        if ($flashProduct) {
            $price = $flashProduct ->price;
        }

        // Return the final price.
        return $price;
}
}
