<?php

namespace Touhidurabir\Presenter;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\Exceptions\PresenterException;
use Touhidurabir\StubGenerator\Concerns\NamespaceResolver;

class PresenterResolver {

    use NamespaceResolver;

    /**
     * Resolve the model presenter class based on model
     *
     * @param  object<\Illuminate\Database\Eloquent\Model> $model
     * @return object
     * 
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterClassNotFound
     */
    public static function resolve(Model $model) {

        $presenterStorePath = config('presenter.presenter_namespace');

        $presenterClass = $presenterStorePath . '\\' . (new static)->resolveClassName(get_class($model)) . config('presenter.class_name_prefix');

        if ( ! class_exists($presenterClass) ) {

            throw PresenterException::presenterClassNotFound($model, $presenterClass);
        }

        $presenter = Container::getInstance()->make($presenterClass);

        return $presenter;
    }
    
}