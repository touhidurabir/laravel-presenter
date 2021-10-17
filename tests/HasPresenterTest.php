<?php

namespace Touhidurabir\Presenter\Tests;

use Orchestra\Testbench\TestCase;
use Touhidurabir\Presenter\Tests\App\User;
use Touhidurabir\Presenter\Tests\App\Profile;
use Touhidurabir\Presenter\Tests\Traits\LaravelTestBootstrapping;

class HasPresenterTest extends TestCase {

    use LaravelTestBootstrapping;

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations() {

        $this->loadMigrationsFrom(__DIR__ . '/App/database/migrations');
        
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });
    }

}