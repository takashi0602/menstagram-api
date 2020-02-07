<?php

namespace App\UseCases;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * 画像の保存
 *
 * Class StoreImagesUseCase
 * @package App\UseCases
 */
class StoreImagesUseCase
{
    /**
     * @param $images
     * @param $isRamens
     * @return array
     */
    public function __invoke($images, $isRamens)
    {
        if (collect($isRamens)->contains(false)) return [];
        $filePaths = collect([]);
        for ($i = 0; $i < collect($images)->count(); $i++) {
            $image = Image::make($images[$i]);
            $fileName = Str::random(16) . '.jpg';
            $storageFilePath = storage_path("app/public/posts/$fileName");
            $image->save($storageFilePath);
            $publicFilePath = asset("posts/$fileName");
            $filePaths->push($publicFilePath);
        }
        return $filePaths->all();
    }
}