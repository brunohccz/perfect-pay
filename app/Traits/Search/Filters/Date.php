<?php

namespace App\Traits\Search\Filters;

use App\Traits\Search\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class Date implements Filter
{
    public static function apply(Builder $query, $value)
    {
        $start = Carbon::parse($value['start'])->startOfDay();
        $end = Carbon::parse($value['end'])->endOfDay();

        return $query->whereBetween('created_at', [
            $start, $end
        ]);
    }
}
