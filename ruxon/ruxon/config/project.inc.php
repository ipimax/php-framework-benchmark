<?php

return array(
    'Path' => realpath(dirname(__FILE__).'/../..'),
    'Url' => isset($_SERVER['HTTP_HOST']) ? 'http://'.$_SERVER['HTTP_HOST'] : false,
    'RuxonPath' => realpath(dirname(__FILE__).'/../../ruxon'),

    // Language
    'Language' => 'Ru',

    // Default language
    'DefaultLanguage' => 'En',

    // Debug Mode
    'DebugMode' => true
);