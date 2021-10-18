<?php

return [

	/*
    |---------------------------------------------------------------------------
    | Should the Hashing Enables
    |---------------------------------------------------------------------------
    | The configuratin of the .env to determine should the ID Hashing enabled 
    | or not for any model that used this package.
    |
    */
	'class_store_path' => env('ID_HASHING', true),


    /*
    |---------------------------------------------------------------------------
    | Unique Key used for Hashing
    |---------------------------------------------------------------------------
    | The unique key to use for all ID hashing and then dehashing . It is advised
    | to set one such.
    |
    */
	'auto_resolving' => env('ID_HASHING_KEY', ''),
];