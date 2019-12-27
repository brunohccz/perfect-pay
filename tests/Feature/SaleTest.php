<?php

namespace Tests\Feature;

use App\Product;
use App\Sale;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_create_a_sale()
    {
        $user = factory(User::class)->create();
        $sale = factory(Sale::class)->make()->toArray();

        $this->actingAs($user)->post('/sales', $sale);

        $this->assertDatabaseHas('sales', $sale);
    }

    /** @test */
    public function test_user_can_update_status_sale()
    {
        $user = factory(User::class)->create();
        $sale = factory(Sale::class)->create();
        $sale->status = Sale::STATUS_CANCELED;

        $attributes = $sale->getAttributes();

        $this->actingAs($user)->patch('/sales/' . $sale->id, $attributes);

        $this->assertDatabaseHas('sales', $attributes);
    }

    /** @test */
    public function test_user_can_update_product_sale()
    {
        $user = factory(User::class)->create();
        $sale = factory(Sale::class)->create();
        $sale->product()->associate(factory(Product::class)->create());

        $attributes = $sale->getAttributes();

        $this->actingAs($user)->patch('/sales/' . $sale->id, $attributes);

        $this->assertDatabaseHas('sales', $attributes);
    }

    /** @test */
    public function test_automatic_calc_discount()
    {
        $sale = factory(Sale::class)->create();
        $sale = tap($sale)->update([
            'discount' => $sale->quantity * $sale->product->price
        ]);

        $this->assertEquals(0, $sale->sale_amount);
    }
}
