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

    'class_name_prefix' => 'Presenter',
];