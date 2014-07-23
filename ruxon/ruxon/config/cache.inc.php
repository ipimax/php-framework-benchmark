<?php

return array(
    
    // Db data cache
    'data' => array(
        'Driver' => 'Memcached',
        'Params' => array(
            'Prefix' => 'data_',
            'Server' => '127.0.0.1',
            'Port' => '3333'
        ),
    ),
    
    // Views cache
    'views' => array(
        'Driver' => 'File',
        'Params' => array(
            'Prefix' => 'views_',
        ),
    ),
    
    // Widgets caache
    'widgets' => array(
        'Driver' => 'File',
        'Params' => array(
            'Prefix' => 'widgets_',
        ),
    ),
    
    // Full pages cache
    'pages' => array(
        'Driver' => 'File',
        'Params' => array(
            'Prefix' => 'pages_',
        ),
    ),
);