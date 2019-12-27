<?php

namespace App\Traits\Search\Filters;

use App\Traits\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class Customer implements Filter
{
    public static function apply(Builder $query, $value)
    {
        return $query->whereCustomerId($value);
    }
}
