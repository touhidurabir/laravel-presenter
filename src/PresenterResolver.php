<?php

namespace Touhidurabir\Presenter;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\Exceptions\PresenterException;
use Touhidurabir\StubGenerator\Concerns\NamespaceResolver;

class PresenterResolver
{
    use NamespaceResolver;

    /**
     * The presenter class name suffix used when none is configured
     *
     * @var string
     */
    public const DEFAULT_CLASS_NAME_SUFFIX = 'Presenter';


    /**
     * Resolve the model presenter class based on model
     *
     * @param  object<\Illuminate\Database\Eloquent\Model> $model
     * @return object
     *
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterClassNotFound
     */
    public static function resolve(Model $model)
    {

        $presenterStorePath = config('presenter.presenter_namespace');

        $presenterClass = $presenterStorePath . '\\' . (new static())->resolveClassName(get_class($model)) . static::classNameSuffix();

        if (! class_exists($presenterClass)) {

            throw PresenterException::presenterClassNotFound($model, $presenterClass);
        }

        $presenter = Container::getInstance()->make($presenterClass);

        return $presenter;
    }


    /**
     * Get the suffix attached to the model class name to resolve its presenter class
     *
     * Reads the 'class_name_suffix' config. The old, misnamed 'class_name_prefix'
     * key is no longer shipped in the package config, so it is only set by a
     * config published from an older version. It is still honoured, unless
     * 'class_name_suffix' was changed from its default.
     *
     * @return string
     */
    public static function classNameSuffix()
    {

        $suffix = config('presenter.class_name_suffix');
        $legacyPrefix = config('presenter.class_name_prefix');

        if ($legacyPrefix !== null && ($suffix === null || $suffix === static::DEFAULT_CLASS_NAME_SUFFIX)) {

            return (string) $legacyPrefix;
        }

        return (string) ($suffix ?? static::DEFAULT_CLASS_NAME_SUFFIX);
    }

}
