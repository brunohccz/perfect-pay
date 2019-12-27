<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Product;
use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    $product = factory(Product::class)->create();
    $customer = factory(Customer::class)->create();

    $discount = $faker->randomFloat(2, 0, $product->price);

    return [
        'product_id'    => $product->id,
        'customer_id'   => $customer->id,
        'quantity'      => $faker->numberBetween(1, 5),
        'discount'      => $discount,
        'status'        => Sale::STATUS_SOLD
    ];
});
