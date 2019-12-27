<?php

namespace App\Traits\Search;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasSearch
{
    protected static function searchable(array $filters)
    {
        $query = static::applyDecorators($filters, self::query());

        return $query->get();
    }

    protected static function applyDecorators(array $params, Builder $query)
    {
        foreach($params as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);
            if(class_exists($decorator) && $value !== null) {
                $query = $decorator::apply($query, $value);
            }
        }

        return $query;
    }

    protected static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($name);
    }
}
