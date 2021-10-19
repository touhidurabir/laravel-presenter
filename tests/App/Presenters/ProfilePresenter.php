<?php

namespace Touhidurabir\Presenter\Tests\App\Presenters;

use Touhidurabir\Presenter\BasePresenter;

class ProfilePresenter extends BasePresenter {

    public function fullname() {

        return "{$this->model->first_name} {$this->model->last_name}";
    }
}