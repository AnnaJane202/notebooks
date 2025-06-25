<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    protected array $keys = [
        'integer',
        'checkbox',
        'select',
        'popular',
    ];


    protected function integer(Builder $builder, $value)
    {
        if (isset($value['from'])) {
            $builder->whereHas('paramProducts', function($q) use ($value) {
                foreach ($value['from'] as $key => $v) {
                    $q->where('param_id', $key)->whereRaw('CAST(value as INT) >= ?', $v);
                }
            });
        }
        if (isset($value['to'])) {
            $builder->whereHas('paramProducts', function($q) use ($value) {
                foreach ($value['to'] as $key => $v) {
                    $q->where('param_id', $key)->whereRaw('CAST(value as INT) <= ?', $v);
                }
            });
        }
    }

    protected function select(Builder $builder, $value)
    {
        $builder->whereHas('paramProducts', function($q) use ($value) {
            foreach ($value as $key => $v) {
                $q->where('param_id', $key)->where('value', $v);
            }
        });
    }

    protected function checkbox(Builder $builder, $value)
    {
        $builder->whereHas('paramProducts', function($q) use ($value) {
            foreach ($value as $key => $v) {
                $q->where('param_id', $key)->whereIn('value', $v);
            }
        });
    }

    protected function popular(Builder $builder, $value)
    {
        $builder->whereHas('paramProducts', function($q) use ($value) {
            foreach ($value as $id) {
                $q->where('param_id', $id)->whereIn('value' !== 'нет');
            }
        });
    }
}
