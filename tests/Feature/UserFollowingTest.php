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

    public function successCase()
    {
        //
    }
}
