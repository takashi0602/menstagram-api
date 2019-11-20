<?php

namespace Tests\Feature\DataProviders;

/**
 * ユーザーのログアウト(異常系)
 *
 * Trait AuthLogoutDataProvider
 * @package Tests\Feature\DataProviders
 */
trait AuthLogoutDataProvider
{
    /**
     * 異常系(アクセストークン)のテストデータの定義
     *
     * @return array
     */
    public function accessTokenProvider()
    {
        return [
            'アクセストークンが無いパターン' => [null],
            'AuthorizationヘッダがBearerではないパターン' => ['takashi'],
            'アクセストークンが短いパターン' => ['Bearer takashi'],
            'アクセストークンが長いパターン' => ['Bearer takashitakashitakashitakashitakashitakashitakashitakashitakashitakashi'],
        ];
    }
}