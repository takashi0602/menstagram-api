<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * シーディング
     *
     * @param array $classNames
     */
    protected function seeding(array $classNames)
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($classNames as $className) {
            Artisan::call('db:seed', ['--class' => $className]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}
