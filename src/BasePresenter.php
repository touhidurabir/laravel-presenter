<?php

namespace Touhidurabir\Presenter;

use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\Exceptions\PresenterException;

abstract class BasePresenter {

    protected $model;

    public function setModel(Model $model) {

        $this->model = $model;

        return $this;
    }

    public function getModel() {

        return $this->model;
    }


    public function __get(string $property) {

        if ( ! $this->__isset($property) ) {

            throw PresenterException::PresentableMethodNotDefine();
        }

        return $this->{$property}();
    }

    public function __isset(string $property) {

        return method_exists($this, $property);
    }
}