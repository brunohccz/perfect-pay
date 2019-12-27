<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Collection;

trait SaleAnalytics
{
    public static function analytics(Collection $sales)
    {
        return collect()->put('sold', [
            'count' => static::countByStatus($sales, static::STATUS_SOLD),
            'total' => static::sumAmountByStatus($sales, static::STATUS_SOLD)
        ])
        ->put('canceled', [
            'count' => static::countByStatus($sales, static::STATUS_CANCELED),
            'total' => static::sumAmountByStatus($sales, static::STATUS_CANCELED)
        ])
        ->put('refunded', [
            'count' => static::countByStatus($sales, static::STATUS_REFUNDED),
            'total' => static::sumAmountByStatus($sales, static::STATUS_REFUNDED)
        ]);
    }

    public static function countByStatus(Collection $sales, int $status)
    {
        return $sales->where('status', $status)->count();
    }

    public static function sumAmountByStatus(Collection $sales, int $status)
    {
        return $sales->where('status', $status)->sum('sale_amount');
    }
}
