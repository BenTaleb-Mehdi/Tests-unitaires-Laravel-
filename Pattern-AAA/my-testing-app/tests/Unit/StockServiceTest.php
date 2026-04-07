<?php

namespace Tests\Feature;

use App\Models\products;
use Tests\TestCase;
use App\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockServiceTest extends TestCase
{
    use RefreshDatabase; // Pour vider la DB à chaque test

    public function test_it_adds_stock_correctly()
    {
        // --- 1. ARRANGE ---
        $product = products::factory()->create(['stock' => 5]);
        $service = new StockService();

        // --- 2. ACT ---
        $service->addStock($product, 10);

        // --- 3. ASSERT ---
        // 5 + 10 = 15
        $this->assertEquals(15, $product->fresh()->stock);
    }
}