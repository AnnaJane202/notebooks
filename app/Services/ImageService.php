<?php

namespace App\Services;

use App\Models\ParamGroup;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ImageService
{
    public static function storeBatch(Product $product, array $data): void
    {
        foreach($data['images'] as $image) {
            $product->images()->create([//сохраняет в базу путь и, видимо, product_id(через релейшн)
                'path' => Storage::disk('public')->put('/images', $image)
            ]);
        }
    }

    public static function destroy($image): void
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }
}
