<?php

namespace App\UseCases;

use Intervention\Image\Facades\Image;

/**
 * 画像の前処理(トリミング)
 *
 * Class PreprocessImagesUseCase
 * @package App\UseCases
 */
class PreprocessImagesUseCase
{
    /**
     * @param $request
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($request)
    {
        $images = collect([]);
        for ($i = 1; $i <= 4; $i++) {
            $file = $request->file("image$i");
            if (is_null($file)) continue;

            $image = Image::make($file);
            $image = $this->trimImage($image)->encode('jpg');
            $images->push($image);
        }
        return $images;
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