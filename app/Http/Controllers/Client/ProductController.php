<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Category\ProductIndexRequest;
use App\Http\Resources\Cart\CartResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamWithPivotValueResource;
use App\Http\Resources\Param\ParamWithValuesResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductWithGroupedParamResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ParamProductService;
use App\Services\ParamService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        $data = $request->validated();
        $products = ProductResource::collection(Product::all())->resolve();
        $products = ProductResource::collection(ProductService::indexByProducts($data))->resolve();

        if ($request->wantsJson()) {
            return $products;
        }

        $params = ParamService::indexByProducts();
        $params = ParamWithValuesResource::collection($params)->resolve();

        $categories = CategoryResource::collection(Category::all())->resolve();
        $ct = session()->get('counter');
        return inertia('Client/Product/Index', compact('products', 'categories', 'params', 'ct'));
    }

    public function show(Product $product)
    {
        $params = ParamService::groupedByParamGroup($product);
        $product = ProductResource::make($product)->resolve();
        $ct = session()->get('counter');
        return inertia('Client/Product/Show', compact('product', 'params', 'ct'));
    }
}
