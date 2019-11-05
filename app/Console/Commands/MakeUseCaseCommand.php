<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * ユースケースのテンプレートを生成するコマンド
 *
 * Class MakeUseCaseCommand
 * @package App\Console\Commands
 */
class MakeUseCaseCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:usecase {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new usecase class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'UseCase';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/usecase.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\UseCases';
    }
}