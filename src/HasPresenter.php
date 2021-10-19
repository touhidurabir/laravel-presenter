<?php

namespace Touhidurabir\Presenter;

use Illuminate\Container\Container;
use Touhidurabir\Presenter\BasePresenter;
use Touhidurabir\Presenter\PresenterResolver;
use Touhidurabir\Presenter\Exceptions\PresenterException;

trait HasPresenter {

    protected $presentable;

    public function setPresenter(string $presenterClass) {

        if ( ! class_exists($presenterClass) ) {

            throw PresenterException::presenterClassNotFound($model, $presenterClass);
        }

        return $this->initPresentable($presenterClass);
    }

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