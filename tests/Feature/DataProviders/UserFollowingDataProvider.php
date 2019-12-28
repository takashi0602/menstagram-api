<?php

namespace Tests\Feature\DataProviders;

/**
 * フォロー一覧
 *
 * Trait UserFollowingDataProvider
 * @package Tests\Feature\DataProviders
 */
trait UserFollowingDataProvider
{
    /**
     * 正常系(type)のテストデータの定義
     *
     * @return array
     */
    public function successTypeProvider()
    {
        return [

        ];
    }

    /**
     * 異常系(ユーザーID)のテストデータの定義
     *
     * @return array
     */
    public function failUserIdProvider()
    {
        return [

        ];
    }

    /**
     * 異常系(フォローID)のテストデータの定義
     *
     * @return array
     */
    public function failFollowIdProvider()
    {
        return [

        ];
    }

    /**
     * 異常系(type)のテストデータの定義
     *
     * @return array
     */
    public function failTypeProvider()
    {
        return [

        ];
    }
}