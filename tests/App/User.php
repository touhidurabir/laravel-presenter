<?php

namespace Touhidurabir\Presenter\Tests\App;

use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\HasPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Touhidurabir\Presenter\Tests\App\Presenters\UserPresenter;

class User extends Model {

    use SoftDeletes;

    use HasPresenter;

    protected $presenter = UserPresenter::class;

    /**
     * The model associated table
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}