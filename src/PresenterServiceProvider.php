<?php

namespace Touhidurabir\Presenter;

use Illuminate\Support\ServiceProvider;
use Touhidurabir\Presenter\Console\GeneratePresenter;

class PresenterServiceProvider extends ServiceProvider {
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        if ( $this->app->runningInConsole() ) {
			$this->commands([
				GeneratePresenter::class
			]);
		}

        $this->publishes([
            __DIR__.'/../config/presenter.php' => base_path('config/presenter.php'),
        ], 'config');
    }
    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->mergeConfigFrom(
            __DIR__.'/../config/presenter.php', 'presenter'
        );
    }
}