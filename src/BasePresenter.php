<?php

namespace Touhidurabir\Presenter;

use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\Exceptions\PresenterException;

abstract class BasePresenter {

    /**
     * The associated model for this presenter
     *
     * @var object<\Illuminate\Database\Eloquent\Model>
     */
    protected $model;


    /**
     * Set the model
     *
     * @param  object<\Illuminate\Database\Eloquent\Model> $model
     * @return self
     */
    public function setModel(Model $model) {

        $this->model = $model;

        return $this;
    }


    /**
     * get the model
     *
     * @return object<\Illuminate\Database\Eloquent\Model>
     */
    public function getModel() {

        return $this->model;
    }


    /**
     * PHP magic method __get to handle the presenter methods as properties
     *
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property) {

        if ( ! $this->__isset($property) ) {

            throw PresenterException::PresentableMethodNotDefine();
        }

        return $this->{$property}();
    }


    /**
     * PHP magic method __isset to handle the isset of a presenter method as property
     *
     * @param  string $property
     * @return bool
     */
    public function __isset(string $property) {

        return method_exists($this, $property);
    }
    
}