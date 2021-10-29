<?php

namespace Touhidurabir\Presenter\Console;

use Exception;
use Throwable;
use Illuminate\Console\Command;
use Touhidurabir\StubGenerator\StubGenerator;
use Touhidurabir\StubGenerator\Concerns\NamespaceResolver;
use Touhidurabir\Presenter\Console\Concerns\CommandExceptionHandler;

class GeneratePresenter extends Command {

    use NamespaceResolver;
    
    /**
     * Process the handeled exception and provide output
     */
    use CommandExceptionHandler;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:presenter
                            {class              : Presenter class name}
                            {--replace          : Should replace an existing one}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Presenter Class Generator';


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Presenter';


    /**
     * Class generator stub path
     *
     * @var string
     */
    protected $stubPath = '/stubs/presenter.stub';


    /**
     * Generated class store path
     *
     * @var string
     */
    protected $classStorePath;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        
        $this->info('Creating presenter class');

        try {

            $this->classStorePath = $this->generateFilePathFromNamespace(
                $this->resolveClassNamespace(
                    $this->argument('class')
                ) ?? config('presenter.presenter_namespace')
            );

            $saveStatus = (new StubGenerator)
                            ->from($this->generateFullPathOfStubFile($this->stubPath), true)
                            ->to($this->classStorePath, true)
                            ->as($this->resolveClassName($this->argument('class')))
                            ->withReplacers([
                                'class'             => $this->resolveClassName($this->argument('class')),
                                'classNamespace'    => $this->resolveClassNamespace($this->argument('class')) ?? config('presenter.presenter_namespace'),
                            ])
                            ->replace($this->option('replace'))
                            ->save();

            if ( $saveStatus ) {

                $this->info('Presenter class generated successfully');
            }
            
        } catch (Throwable $exception) {
            
            $this->outputConsoleException($exception);

            return 1;
        }
    }


    /**
     * Genrate the stub file full absolute path
     *
     * @param  string $stubRelativePath
     * @return string
     */
    protected function generateFullPathOfStubFile(string $stubRelativePath) {

        return __DIR__ . $stubRelativePath;
    }
    
}
