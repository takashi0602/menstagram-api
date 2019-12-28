<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\UserFollowedDataProvider;
use Tests\TestCase;

/**
 * フォロワー一覧
 *
 * Class UserFollowedTest
 * @package Tests\Feature
 */
class UserFollowedTest extends TestCase
{
    use UserFollowedDataProvider;

    public function successCase()
    {
        //
    }
}
