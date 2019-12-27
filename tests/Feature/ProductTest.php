<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function test_user_can_create_a_product()
    {
        $user = factory(User::class)->create();
        $attributes = factory(Product::class)->make()->toArray();

        $this->actingAs($user)->post('/products', $attributes);

        $this->assertDatabaseHas('products', $attributes);
    }

    /** @test */
    public function test_user_can_update_a_product()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();
        $product->name = 'Macbook Pro';

        $this->actingAs($user)
            ->patch('/products/' . $product->id, $product->toArray());

        $this->assertDatabaseHas('products', $product->toArray());
    }

    /** @test */
    public function test_user_can_soft_delete_a_product()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $this->assertDatabaseHas('products', $product->toArray());

        $this->actingAs($user)->delete('/products/' . $product->id);

        $this->assertSoftDeleted('products', $product->toArray());
    }
}
