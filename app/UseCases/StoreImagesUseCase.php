<?php

namespace App\UseCases;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Class StoreImagesUseCase
 * @package App\UseCases
 */
class StoreImagesUseCase
{
    /**
     * 画像の保存
     *
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($request)
    {
        $filePaths = collect([]);
        for ($i = 1; $i <= 4; $i++) {
            if (is_null($request->file("image$i"))) continue;
            $extension = $request->file("image$i")->guessClientExtension();
            $fileName = Str::random(16) . ".$extension";
            $storageFilePath = storage_path("app/public/posts/$fileName");
            $image = Image::make($request->file("image$i"));
            if ($image->width() > $image->height()) {
                $image->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($storageFilePath);
            }
            else {
                $image->resize(null, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($storageFilePath);
            }
            $publicFilePath = asset("storage/posts/$fileName");
            $filePaths->push($publicFilePath);
        }

        // TODO: 画像が投稿できたかの確認

        return $filePaths;
    }
}