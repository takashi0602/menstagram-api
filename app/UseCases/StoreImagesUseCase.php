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
     * @param $request
     * @param $isRamens
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($request, $isRamens)
    {
        $filePaths = collect([]);
        for ($i = 1; $i <= 4; $i++) {
            $file = $request->file("image$i");

            if (is_null($file)) continue;
            if (!$isRamens[$i - 1]) continue;

            $fileName = $this->getFileName($file);
            $storageFilePath = storage_path("app/public/posts/$fileName");
            $image = Image::make($file);
            $this->trimImage($image)->save($storageFilePath);
            $publicFilePath = asset("storage/posts/$fileName");
            $filePaths->push($publicFilePath);
        }

        return $filePaths;
    }

    /**
     * ファイルネームの取得
     *
     * @param $file
     * @return string
     */
    protected function getFileName($file)
    {
        $extension = $file->guessClientExtension();
        $fileName = Str::random(16) . ".$extension";
        return $fileName;
    }

    /**
     * 画像のトリミング
     *
     * @param $image
     * @return mixed
     */
    protected function trimImage($image)
    {
        if ($image->width() > $image->height()) {
            return $image->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        return $image->resize(null, 1024, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}