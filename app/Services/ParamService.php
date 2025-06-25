<?php

namespace App\Services;

use App\Http\Resources\Param\ParamWithPivotValueResource;
use App\Models\Category;
use App\Models\Param;
use App\Models\ParamProduct;
use App\Models\Product;
use Illuminate\Support\Collection;

class ParamService
{
    public static function store(array $data): Param
    {
        return Param::create($data);
    }

    public static function update(Param $param, array $data): Param
    {
        $param->update($data);
        return $param->fresh();
    }

    public static function indexByCategories(Category $category): Collection
    {
        $paramProducts = $category->paramProducts;


        $params = Param::whereIn('id', $paramProducts->pluck( 'param_id'))->whereIn('label', [1, 3])->get();


        $paramProducts = $paramProducts->groupBy('param_id');

        foreach ($params as $param) {
            $param->param_values = $paramProducts[$param->id]->unique('value')->sortBy('value')->pluck('value')->toArray();
        }

        return $params;
    }

    public static function indexByProducts(): Collection
    {
        $paramProducts = ParamProduct::all();

        $params = Param::whereIn('id', $paramProducts->pluck( 'param_id'))->whereIn('label', [1, 3])->get();
        $paramProducts = $paramProducts->groupBy('param_id');

        foreach ($params as $param) {
            $param->param_values = $paramProducts[$param->id]->unique('value')->sortBy('value')->pluck('value')->toArray();
        }

        return $params;
    }

    public static function groupedByParamGroup(Product $product)
    {
//      $params = $product->params;
      $params =  ParamWithPivotValueResource::collection($product->params)->resolve();
      $params = collect($params)->groupBy('param_group')->toArray();





//        foreach ($params as $param) {
//
//        }


      return $params;

    }

}
