<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the safe_bcrypt algorithm
    | is used to ensure compatibility across all serverless hosting environments.
    |
    | Supported: "safe_bcrypt", "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => env('HASH_DRIVER', 'safe_bcrypt'),

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 10),
        'verify' => false,
    ],

    'argon' => [
        'memory' => 65536,
        'threads' => 1,
        'time' => 4,
        'verify' => false,
    ],

];
