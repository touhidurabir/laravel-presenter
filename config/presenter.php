<?php

return [

    /*
    |---------------------------------------------------------------------------
    | The base presenter namespace
    |---------------------------------------------------------------------------
    | Define the namespace of the presenter class which will be used to decide
    | where the presenter class should be stored
    |
    */
    'presenter_namespace' => 'App\\Presenters',


    /*
    |---------------------------------------------------------------------------
    | Presenter class auto resolve based on model name
    |---------------------------------------------------------------------------
    | If the $presenter property not defined in the model class and if this set
    | to true, it will try to resolve the presenter class based on model name
    | and based on config provided presenter_namespace location.
    |
    */
    'auto_resolve' => true,


    /*
    |---------------------------------------------------------------------------
    | Presenter class name suffix
    |---------------------------------------------------------------------------
    | The suffix attached to the model class name to auto resolve its presenter
    | class, e.g. User => UserPresenter. It replaces the old, misnamed
    | 'class_name_prefix' key, which is still honoured if your published config
    | has it and this key is left at its default.
    |
    */
    'class_name_suffix' => 'Presenter',
];
