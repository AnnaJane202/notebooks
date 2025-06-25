<?php

namespace App\Services;

use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public static function store(array $data): Product
    {
        try {
            DB::beginTransaction();

            $product =  Product::create($data['product']);//сохраняет в базу продукт
            ProductService::attachBatchParams($product, $data);
            ImageService::storeBatch($product, $data);//сохраняет в базу path картинки

            DB::commit();
        } catch (\Exception $exception) {
            abort(500, 'store transaction failed');
            DB::rollBack();
        }

        return $product;//возвращает продукт

    }

    public static function update(Product $product, array $data): Product
    {
        try {
            DB::beginTransaction();
            $product->update($data['product']);
            ProductService::syncBatchParams($product, $data);
            ImageService::storeBatch($product, $data);
            DB::commit();
        } catch (\Exception $exception) {
            abort(500, 'update transaction failed');
            DB::rollBack();
        }

        return $product->fresh();
    }

    public static function indexByCategories(Category $category, array $data): Collection
    {
        $products = Product::where('category_id', $category->id)->filter($data);
        return $products->get();
    }

    public static function indexByProducts(array $data): Collection
    {
        $categories = Category::all();
        $products = Product::whereIn('category_id', $categories->pluck('id'))->filter($data);
        return $products->get();
    }

    public static function attachBatchParams(Product $product, array $data): void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], [
                'value' => $param['value']
            ]);
        }
    }

    public static function syncBatchParams(Product $product, array $data): void
    {
        $product->params()->detach();
        ProductService::attachBatchParams($product, $data);

    }
}
