<?php

namespace App\Traits\Search\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * Apply a given search value to the builder instance.
     */
    public static function apply(Builder $query, $value);
}
