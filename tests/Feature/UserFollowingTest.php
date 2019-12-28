<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\UserFollowingDataProvider;
use Tests\TestCase;

/**
 * フォロー一覧
 *
 * Class UserFollowingTest
 * @package Tests\Feature
 */
class UserFollowingTest extends TestCase
{
    use UserFollowingDataProvider;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class, \CreateFollowsSeeder::class]);
    }

    /**
     * 正常系
     */
    public function successCase()
    {
        //
    }

    /**
     * 正常系(ユーザーIDの指定あり)
     */
    public function successUserIdCase()
    {
        //
    }

    /**
     * 正常系(フォローIDの指定あり)
     */
    public function successFollowIdCase()
    {
        //
    }

    /**
     * 正常系(フォローID, typeの指定あり)
     */
    public function successTypeCase()
    {
        //
    }

    /**
     * 異常系(ユーザーID)
     */
    public function failUserIdCase()
    {
        //
    }

    /**
     * 異常系(フォローID)
     */
    public function failFollowIdCase()
    {
        //
    }

    /**
     * 異常系(type)
     */
    public function failTypeCase()
    {
        //
    }
}
