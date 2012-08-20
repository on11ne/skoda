<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Мотивационная программа Skoda',

	// preloading 'log' compofcddnent
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'application.helpers.*',
	),

	'modules'=>array(

        'admin'=>array(

        ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'dfa-98+_(',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','192.168.7.148'),
		),
	),

	// application components
	'components'=>array(
        'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'FacebookOAuthService',
                    'client_id' => '273754669405205',
                    'client_secret' => 'fb932f67e076760bba15ab820012b210',
                ),
                'vkontakte' => array(
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'VKontakteOAuthService',
                    'client_id' => '3083076',
                    'client_secret' => '3Q7gmzHm2TopKKpZ5nPT',
                ),
                /*'mailru' => array(
                    // register your app here: http://api.mail.ru/sites/my/add
                    'class' => 'MailruOAuthService',
                    'client_id' => '...',
                    'client_secret' => '...',
                ),
                'odnoklassniki' => array(
                    // register your app here: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
                    'class' => 'OdnoklassnikiOAuthService',
                    'client_id' => '...',
                    'client_public' => '...',
                    'client_secret' => '...',
                    'title' => 'Odnokl.',
                ),*/
            ),
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=skoda',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'qwerty',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'clientScript'=>array(
            'packages'=>array(
                'fancybox' => array(
                    'baseUrl'=>'/assets/fancybox',
                    'js' => array(
                        'source/jquery.fancybox.pack.js',
                        'lib/jquery.mousewheel-3.0.6.pack.js',
                        'source/helpers/jquery.fancybox-buttons.js',
                        'source/helpers/jquery.fancybox-media.js',
                        'source/helpers/jquery.fancybox-thumbs.js',
                    ),
                    'css' => array(
                        'source/jquery.fancybox.css',
                        'source/jquery.fancybox-buttons.css',
                        'source/jquery.fancybox-thumbs.css',
                    ),
                ),
                'bxslider' => array(
                    'baseUrl'=>'/assets/js',
                    'js' => array(
                        'jquery.bxSlider.min.js'
                    ),
                    'depends' => array('jquery')
                ),
            ),
        ),
        'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),
	),
    'sourceLanguage'    =>'ru',
    'language'          =>'ru',
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail' => 'webmaster@skoda.ru',
        'adminName' => 'Сайт мотивационной программы Skoda Нижний Новгород',
        'moderatorEmail' => 'denis@ekimov.su',
        'salt' => 'd-a08a80-f&a-8fx0v8nbz8fg-8sgA-8GS-',
        'contest_id' => 1
	),
);