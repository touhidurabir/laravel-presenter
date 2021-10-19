<?php

namespace Touhidurabir\Presenter;

use Illuminate\Container\Container;
use Touhidurabir\Presenter\BasePresenter;
use Touhidurabir\Presenter\PresenterResolver;
use Touhidurabir\Presenter\Exceptions\PresenterException;

trait HasPresenter {

    /**
     * The presenter class instance
     *
     * @var object
     */
    protected $presentable;


    /**
     * Set the presenter of a model on fly later
     *
     * @param  string $presenterClass
     * @return object
     * 
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterClassNotFound
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterNotValidInstanceOfBase
     */
    public function setPresenter(string $presenterClass) {

        if ( ! class_exists($presenterClass) ) {

            throw PresenterException::presenterClassNotFound($model, $presenterClass);
        }

        return $this->initPresentable($presenterClass);
    }


    /**
     * Allow the access of presenter class
     *
     * @return object
     * 
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterNotDefined
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterNotValidInstanceOfBase
     */
    public function present() {

        if ( $this->presentable ) {

            return $this->presentable;
        }

        if ( ! $this->presenter && config('presenter.auto_resolve') ) {

            return $this->initPresentable();
        }

        if ( ! $this->presenter ) {

            throw PresenterException::presenterNotDefined($this);
        }

        if ( ! $this->presentable ) {

            return $this->initPresentable($this->presenter);
        }
    }


    /**
     * Initialize the presenter class instance and set the associated model property
     *
     * @param  mixed<string|null> $presenterClass
     * @return object
     * 
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterNotDefined
     * @throws \Touhidurabir\Presenter\Exceptions\PresenterException::presenterNotValidInstanceOfBase
     */
    protected function initPresentable(string $presenterClass = null) {

        $this->presentable = $presenterClass 
                                ? Container::getInstance()->make($presenterClass)
                                : PresenterResolver::resolve($this);

        if ( ! $this->presentable instanceof BasePresenter ) {

            throw PresenterException::presenterNotValidInstanceOfBase($this, get_class($this->presentable));
        }

        $this->presentable = $this->presentable->setModel($this);

        return $this->presentable;
    }

}