<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Category\ProductIndexRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Param;
use App\Models\ParamProduct;
use App\Services\ParamService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productIndex(Category $category, ProductIndexRequest $request)
    {
        $data = $request->validated();

        $products = ProductResource::collection($category->products)->resolve();
        $products = ProductResource::collection(ProductService::indexByCategories($category, $data))->resolve();

        if ($request->wantsJson()) {
            return $products;
        }

        $params = ParamService::indexByCategories($category);
        $category = CategoryResource::make($category)->resolve();
        $params = ParamWithValuesResource::collection($params)->resolve();
        $ct = session()->get('counter');

        return inertia('Client/Category/ProductIndex', compact( 'params','products', 'category', 'ct'));
    }
}
