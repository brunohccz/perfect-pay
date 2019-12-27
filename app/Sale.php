<?php

namespace App;

use App\Traits\Models\SaleAnalytics;
use App\Traits\Search\HasSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use SaleAnalytics, HasSearch;

    const STATUS_SOLD = 1;
    const STATUS_CANCELED = 2;
    const STATUS_REFUNDED = 3;

    protected $fillable = ['product_id', 'customer_id', 'quantity', 'discount', 'sale_amount', 'status'];

    protected $with = ['product', 'customer'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
