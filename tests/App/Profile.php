<?php

namespace Touhidurabir\Presenter\Tests\App;

use Illuminate\Database\Eloquent\Model;
use Touhidurabir\Presenter\HasPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model {

    use SoftDeletes;

    use HasPresenter;

    /**
     * The model associated table
     *
     * @var string
     */
    protected $table = 'profiles';


    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}