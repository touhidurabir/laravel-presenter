<?php

namespace Touhidurabir\Presenter\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\BasePresenter;

class PresenterException extends Exception {
    
    /**
     * Generate exception object if presenter class not defined
     *
     * @param  object<\Illuminate\Database\Eloquent\Model> $model
     * @return object<\Excaption>
     */
    public static function presenterNotDefined(Model $model) {
        
        return new static(
            sprintf("Presenter not defined model class [%s]", get_class($model))
        );
    }


    /**
     * Generate exception object if presenter class not a valid instance of base presenter class
     *
     * @param  object<\Illuminate\Database\Eloquent\Model>  $model
     * @param  string                                       $presenterClass
     * 
     * @return object<\Excaption>
     */
    public static function presenterNotValidInstanceOfBase(Model $model, string $presenterClass) {

        return new static(
            sprintf(
                "The presenter [%s] class not valid instance of [%s] for model [%s]", 
                $presenterClass,
                BasePresenter::class,
                get_class($model)
            )
        );
    }


    /**
     * Generate exception object if presenter class not a found at given path/namespace
     *
     * @param  object<\Illuminate\Database\Eloquent\Model>  $model
     * @param  string                                       $presenterClass
     * 
     * @return object<\Excaption>
     */
    public static function presenterClassNotFound(Model $model, string $presenterClass) {
        
        return new static(
            sprintf(
                "The presenter class [%s] not found for model [%s]", 
                $presenterClass, 
                get_class($model)
            )
        );
    }
    
}