<?php

namespace Touhidurabir\Persenter;

use Illuminate\Support\ServiceProvider;
use Touhidurabir\Persenter\Console\GeneratePersenter;

class PersenterServiceProvider extends ServiceProvider {
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        if ( $this->app->runningInConsole() ) {
			$this->commands([
				GeneratePersenter::class
			]);
		}

        $this->publishes([
            __DIR__.'/../config/persenter.php' => base_path('config/persenter.php'),
        ], 'config');
    }
    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        $this->mergeConfigFrom(
            __DIR__.'/../config/persenter.php', 'persenter'
        );
    }
}