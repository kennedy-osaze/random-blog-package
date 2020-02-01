<?php

return [
    'default' => env('BLOG_DRIVER', 'file'),

    'drivers' => [

        'file' => [
            'path' => storage_path('app/blogs'),
        ],

    ],
];
