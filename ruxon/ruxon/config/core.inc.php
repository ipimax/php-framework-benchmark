<?php

return array(
    
    // Init Filters
    'Filters' => array(
        
        // Init Toolkit's
        'ComposeTools' => array(
            'system' => array(
                'class' => 'SystemToolkit'
            ),

            'response' => array(
                'class' => 'Response'
            ),
            
            'client' => array(
                'class' => 'Client'
            ),
            
            'assetManager' => array(
                'class' => 'AssetManager',
                'fastCheck' => true
            ),
            
            'session' => array(
                'class' => 'SessionFileDriver'
            ),

            'image' => array(
                'class' => 'ImageToolkit',
                'driver' => 'GD'
            ),
            
            'auth' => array(
                'class' => 'AuthFile',
                'users' => array(
                    array('login' => 'demo', 'password' => 'demo'),
                    array('login' => 'admin', 'password' => 'admin', 'admin' => true)
                ),

                'loginUrl' => '/app/user/login'
            ),
            
            'mail' => array(
                'class' => 'Mail'
            ),

            'emailEvent' => array(
                'class' => 'EmailEvent',
                'fromName' => 'Ruxon Blog App',
                'fromEmail' => 'no@ruxon-framework.ru'
            ),

            /*'smsEvent' => array(
                'class' => 'SmsEvent',
                'handlerClass' => 'BaseSmsSms',
                'handlerParams' => array(
                    'login' => '71234567123',
                    'password' => 'password'
                )
            ),*/

            'fileStorage'=>array(
                'class'=>'StorageFileSystem',
                'buckets' => array(

                    'images' => array(
                        'basePath'=>'~/uploads/images',
                        'baseUrl'=>'~/uploads/images',
                    ),
                    
                    'files' => array(
                        'basePath'=>'~/uploads/files',
                        'baseUrl'=>'~/uploads/files',
                    )
                )
            ),

            'urlManager' => array(
                'class' => 'UrlManagerToolkit',
                'urlFormat'=>'path',
            ),

            'i18n' => [
                'class' => 'I18n',
                'translations' => [
                    '*' => [
                        'class' => '\\PhpMessageSource'
                    ]
                ]
            ]
        ),
        
        'Cache'
    ),

    // Init Events
    'Events' => array(
        'beforeLoadPackages'   => array(),
        'afterLoadPackages'    => array(),
        'beforeLoadFilters'    => array(),
        'afterLoadFilters'     => array(),
        'beforeLoadExtensions' => array(),
        'afterLoadExtensions'  => array(),
        'beforeExecute'        => array(),
        'afterExecute'         => array()
    ),

    // Init Extensions
    'Extensions' => array(),

    // Applications
    'Applications' => array(

        // Public Site
        'WebApplication' => array(
            'Class' => 'WebApplication',
            'Name' => 'Website Application',

            'Default' => array(
                'Module' => 'App',
                'Controller' => 'Index',
                'Action' => 'Index'
            ),

            'Routes' => array(

                // module/controller/action/id
                'Full' => array(
                    'Pattern' => '([A-Za-z0-9_]+)/([A-Za-z0-9_]+)/([A-Za-z0-9_]+)/([0-9]+)',
                    'Params' => array(
                        'Module' => '$1',
                        'Controller' => '$2',
                        'Action' => '$3',
                        'Id' => '$4'
                    )
                ),

                // module/controller/action
                'Action' => array(
                    'Pattern' => '([A-Za-z0-9_]+)/([A-Za-z0-9_]+)/([A-Za-z0-9_]+)',
                    'Params' => array(
                        'Module' => '$1',
                        'Controller' => '$2',
                        'Action' => '$3'
                    )
                ),

                // module/controller
                'Controller' => array(
                    'Pattern' => '([A-Za-z0-9_]+)/([A-Za-z0-9_]+)',
                    'Params' => array(
                        'Module' => '$1',
                        'Controller' => '$2',
                        'Action' => 'Index'
                    )
                ),

                // module
                'Controller' => array(
                    'Pattern' => '([A-Za-z0-9_]+)',
                    'Params' => array(
                        'Module' => '$1',
                        'Controller' => 'Index',
                        'Action' => 'Index'
                    )
                )
            ),

            'Filters' => array(


                'ComposeTools' =>array(
                    'request' => array(
                        'class' => 'Request'
                    ),

                    'theme' => array(
                        'class' => 'Theme',
                        'theme' => 'default',
                        'layout' => 'index'
                    )
                )
            ),
            'Extensions' => array(
                //'TwigTemplater'
            ),
            'Events' => array()
        ),

        // Console app
        'ConsoleApplication' => array(
            'Class' => 'ConsoleApplication',
            'Name' => 'Console Application',
            'Filters' => array(
                'ComposeTools' =>array(
                    'request' => array(
                        'class' => 'ConsoleRequest'
                    ),
                ),
            ),
            'Extensions' => array(),
            'Events' => array()
        )
    ),
);