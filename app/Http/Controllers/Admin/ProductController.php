<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Param\ParamResource;
use App\Http\Resources\ParamGroup\ParamGroupResource;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Param;
use App\Models\ParamGroup;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $products = ProductResource::collection($products)->resolve();
        return inertia('Admin/Product/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $paramGroups = ParamGroupResource::collection(ParamGroup::all())->resolve();
        $params = ParamResource::collection(Param::all())->resolve();
        return inertia('Admin/Product/Create', compact('categories', 'paramGroups', 'params'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validationData();
        $product = ProductService::store($data);
        return ProductResource::make($product)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = ProductResource::make($product)->resolve();
        return inertia('Admin/Product/Show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        $product = ProductResource::make($product)->resolve();
        $params = ParamResource::collection(Param::all())->resolve();
        return inertia('Admin/Product/Edit', compact('product', 'categories', 'params'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validationData();
        $product = ProductService::update($product, $data);
        return ProductResource::make($product)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'success'
        ], Response::HTTP_OK);
    }
}
