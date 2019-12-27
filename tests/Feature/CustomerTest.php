<?php

namespace Tests\Feature;

use App\Customer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function test_user_can_create_a_customer()
    {
        $user = factory(User::class)->create();
        $attributes = factory(Customer::class)->make()->toArray();

        $this->actingAs($user)->post('/customers', $attributes);

        $this->assertDatabaseHas('customers', $attributes);

        $this->actingAs($user)->get('/customers')->assertSee($attributes['name']);
    }

    /** @test */
    public function test_user_can_update_a_customer()
    {
        $user = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $customer->name = 'John Doe';

        $this->actingAs($user)
            ->patch('/customers/' . $customer->id, $customer->toArray());

        $this->assertDatabaseHas('customers', $customer->toArray());
    }

    /** @test */
    public function test_user_can_soft_delete_a_customer()
    {
        $user = factory(User::class)->create();
        $customer = factory(Customer::class)->create();

        $this->assertDatabaseHas('customers', $customer->toArray());

        $this->actingAs($user)->delete('/customers/' . $customer->id);

        $this->assertSoftDeleted('customers', $customer->toArray());
    }
}
