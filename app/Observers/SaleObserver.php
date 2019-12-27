<?php

namespace App\Observers;

use App\Sale;

class SaleObserver
{
    public function creating(Sale $sale)
    {
        $sale->sale_amount = ($sale->product->price * $sale->quantity) - $sale->discount;
        $sale->status = Sale::STATUS_SOLD;
    }

    public function updating(Sale $sale)
    {
        $sale->sale_amount = ($sale->product->price * $sale->quantity) - $sale->discount;
    }
}
