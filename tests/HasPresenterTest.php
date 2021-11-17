<?php

namespace Touhidurabir\Presenter\Tests;

use Exception;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use Touhidurabir\Presenter\BasePresenter;
use Touhidurabir\Presenter\Tests\App\User;
use Touhidurabir\Presenter\Tests\App\Profile;
use Touhidurabir\Presenter\Tests\App\Presenters\UserPresenter;
use Touhidurabir\Presenter\Tests\App\Presenters\ProfilePresenter;
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


    /**
     * @test
     */
    public function model_will_have_proper_presentable_access() {

        $user = new User;

        $this->assertInstanceof(BasePresenter::class, $user->present());
        $this->assertInstanceof(UserPresenter::class, $user->present());
    }


    /**
     * @test
     */
    public function it_can_auto_resolve_if_presenter_not_defined() {

        Config::set('presenter.presenter_namespace', 'Touhidurabir\\Presenter\\Tests\\App\\Presenters');

        $profile = new Profile;

        $this->assertInstanceof(BasePresenter::class, $profile->present());
        $this->assertInstanceof(ProfilePresenter::class, $profile->present());
    }


    /**
     * @test
     */
    public function through_presenter_the_presentable_methods_can_be_accessed() {

        $user = new User;
        
        $this->assertIsString($user->present()->test);
    }


    /**
     * @test
     */
    public function will_throw_exception_if_not_proper_presenter_class_found() {

        $profile = new Profile;

        $this->expectException(Exception::class);

        $profile->setPresenter('Touhidurabir\\Presenter\\Tests\\ProfilePresenter');
    }


    /**
     * @test
     */
    public function will_throw_exception_if_invoked_presentable_method_not_defined_in_presenter_class() {

        $profile = new Profile;

        $this->expectException(Exception::class);

        $profile->present()->nonExistedPresentableMethod();
    }


    /**
     * @test
     */
    public function can_set_presenter_on_fly_on_model_instance() {

        $profile = new Profile;

        $profile->setPresenter('Touhidurabir\\Presenter\\Tests\\App\\Presenters\\ProfilePresenter');

        $this->assertInstanceof(BasePresenter::class, $profile->present());
        $this->assertInstanceof(ProfilePresenter::class, $profile->present());

        $this->assertIsString($profile->present()->fullname);
    }

}