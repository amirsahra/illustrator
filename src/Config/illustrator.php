<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Essential configs of the illustrator package
    |--------------------------------------------------------------------------
    |
    | All the values in this file are important and necessary,
    | and if you delete it and give an incorrect value, an error will occur.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | You can choose the disk you want.
    | This is the default value, and if needed,
    | you can choose the desired disk when saving the image.
    |
    | Supported Drivers: "local", "public"
    |
    */
    'disk' => 'public',

    /*
    |--------------------------------------------------------------------------
    | Saving the image path
    |--------------------------------------------------------------------------
    |
    | The values of this array for image storage include the name and storage
    | location.Note that these values are default, and you can specify the
    | storage location and file name when saving the image.
    |
    */
    'image_path' => [
        // Default directory to save images
        'dir' => 'illustrator/images',

        /*
        |--------------------------------------------------------------------------
        | Image random string
        |--------------------------------------------------------------------------
        |
        | If you want the name of the image to be created by default and include a
        | random string, set this feature to active and set the string length.
        |
        */
        'random_string' => [
            'is_active' => false,
            'length' => 10,
        ],

        /*
        |--------------------------------------------------------------------------
        | Image prefix
        |--------------------------------------------------------------------------
        |
        | If you want the name of the image to be created by default and include a
        | prefix, set this feature to active and set the prefix value.
        |
        */
        'prefix' => [
            'is_active' => true,
            'value' => 'illustrator',
        ],

        /*
        |--------------------------------------------------------------------------
        | Image postfix
        |--------------------------------------------------------------------------
        |
        | If you want the name of the image to be created by default and include a
        | postfix, set this feature to active and set the postfix value.
        |
        */
        'postfix' => [
            'is_active' => false,
            'value' => 'illustrator',
        ]
    ],

];