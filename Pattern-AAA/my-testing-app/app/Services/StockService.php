<?php

namespace App\Services;
use App\Models\products;

class StockService
{
    public function addStock(products $product, int $quantity): void
    {
        $product->increment('stock', $quantity);
    }
}