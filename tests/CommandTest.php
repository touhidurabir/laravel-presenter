<?php

namespace Touhidurabir\Presenter\Tests;

use Orchestra\Testbench\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Touhidurabir\Presenter\Tests\App\User;
use Touhidurabir\Presenter\Tests\App\Profile;
use Touhidurabir\Presenter\Tests\Traits\LaravelTestBootstrapping;

class CommandTest extends TestCase {

    use LaravelTestBootstrapping;

    /**
     * The testable dummy command
     *
     * @var object<\Symfony\Component\Console\Tester\CommandTester>
     */
    protected $regenerationCommand;


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


    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void {

        parent::setUp();

        $this->configureTestCommand();
    }


    protected function configureTestCommand() {

        $command = new RegenerateModelHashid;
        $command->setLaravel($this->app);

        $this->regenerationCommand = new CommandTester($command);
    }

}
