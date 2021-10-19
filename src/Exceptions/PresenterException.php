<?php

namespace Touhidurabir\Presenter\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\BasePresenter;

class PresenterException extends Exception {
    
    public static function presenterNotDefined(Model $model) {
        
        return new static(
            sprintf("Presenter not defined model class [%s]", get_class($model))
        );
    }

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