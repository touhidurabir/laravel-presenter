<?php

namespace Touhidurabir\Presenter\Tests;

use Exception;
use RuntimeException;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Touhidurabir\Presenter\Tests\App\User;
use Touhidurabir\Presenter\Tests\App\Profile;
use Symfony\Component\Console\Tester\CommandTester;
use Touhidurabir\Presenter\Tests\Traits\FileHelpers;
use Touhidurabir\Presenter\Tests\Traits\LaravelTestBootstrapping;

class CommandTest extends TestCase {

    use LaravelTestBootstrapping;

    use FileHelpers;

    /**
     * Presenter class store full absolute path based on config settings
     *
     * @var string
     */
    protected $presenterStoreFullPath;


    /**
     * Generate the presenter class store full absolute path based on config settings
     *
     * @return void
     */
    protected function generatePresenterClassStoreFullPath() {

        $this->presenterStoreFullPath = $this->sanitizePath(
            str_replace(
                '/public', 
                $this->sanitizePath($this->generateFilePathFromNamespace(config('presenter.presenter_namespace'))), 
                public_path()
            )
        );
    }


    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void {

        parent::setUp();

        $this->generatePresenterClassStoreFullPath();

        $self = $this;

        $this->beforeApplicationDestroyed(function () use ($self) {

            if ( File::isDirectory($self->presenterStoreFullPath) ) {

                array_map('unlink', glob($self->presenterStoreFullPath . '*.*'));

                rmdir($self->presenterStoreFullPath);
            }
        });
    }


    /**
     * @test
     */
    public function presenter_command_will_run() {
        
        $command = $this->artisan('make:presenter UserPresenter');

        $command->assertExitCode(0);

        $command = $this->artisan('make:presenter UserPresenter --replace');

        $command->assertExitCode(0);
    }


    /**
     * @test
     */
    public function command_will_fail_if_presenter_class_not_give() {

        $this->expectException(RuntimeException::class);

        $this->artisan('make:presenter');
    }


    /**
     * @test
     */
    public function it_will_failed_if_class_already_exists_and_not_instruct_to_replace() {

        $this->artisan('make:presenter', ['class' => 'ProfilePresenter'])->assertExitCode(0);;

        $this->artisan('make:presenter', ['class' => 'ProfilePresenter'])->assertExitCode(1);;
    }


    /**
     * @test
     */
    public function it_will_generate_proper_presenter_class_at_given_path() {

        $this->artisan('make:presenter', ['class' => 'ProfilePresenter'])->assertExitCode(0);

        $this->assertTrue(File::exists($this->presenterStoreFullPath . 'ProfilePresenter.php'));
    }


    /**
     * @test
     */
    public function it_will_generate_presenter_class_with_proper_content() {

        $this->artisan('make:presenter TestPresenter --replace')->assertExitCode(0);

        $this->assertEquals(
            File::get($this->presenterStoreFullPath . 'TestPresenter.php'),
            File::get(__DIR__ . '/App/Presenters/TestPresenter.php'),
        );
    }

}
