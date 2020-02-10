<?php

namespace App\UseCases;

use App\Models\Slurp;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * 画像パスの保存
 *
 * Class SlurpUseCase
 * @package App\UseCases
 */
class SlurpUseCase
{
    /**
     * @param $filePaths
     * @param $isRamens
     * @return array
     */
    public function __invoke($filePaths, $isRamens)
    {
        $slurpId = 0;
        if (!collect($isRamens)->contains(false)) {
            $slurpId = DB::transaction(function () use ($filePaths, $isRamens) {
                User::where('id', user()->id)->increment('slurp_count');

                $slurpId = Slurp::create([
                    'user_id' => user()->id,
                    'images'  => $this->filteredFilePaths($filePaths, $isRamens),
                ])->id;

                return $slurpId;
            }, 5);
        }

        return [
            'slurp_id'  => $slurpId,
            'is_ramens' => $isRamens,
        ];
    }

    /**
     * isRamensの真偽値に基づいてfilePathsをフィルタにかける
     *
     * @param $filePaths
     * @param $isRamens
     * @return array
     */
    private function filteredFilePaths($filePaths, $isRamens)
    {
        $filteredFilePaths = [];
        for ($i = 0; $i < count($filePaths); $i++) {
            if ($isRamens) $filteredFilePaths[] = $filePaths[$i];
        }
        return $filteredFilePaths;
    }
}