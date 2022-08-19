<?php

declare(strict_types=1);

namespace Leeto\MoonShine\Tests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Arr;
use Leeto\MoonShine\Models\MoonshineUser;
use Leeto\MoonShine\MoonShine;
use Leeto\MoonShine\Providers\MoonShineServiceProvider;
use Leeto\MoonShine\Resources\MoonShineUserResource;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use InteractsWithViews;

    protected Authenticatable $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('moonshine:install');

        $this->refreshApplication();
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(realpath('./database/migrations'));

        Factory::guessFactoryNamesUsing(function ($factory) {
            $factoryBasename = class_basename($factory);

            return "Leeto\MoonShine\Database\Factories\\$factoryBasename".'Factory';
        });

        config(Arr::dot(config('moonshine.auth', []), 'auth.'));

        $this->user = MoonshineUser::query()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('test')
        ]);

        app(MoonShine::class)->registerResources([
            MoonShineUserResource::class
        ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
            MoonShineServiceProvider::class,
        ];
    }
}
