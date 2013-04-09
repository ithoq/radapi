<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Ads Management System',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',		
	),
	//'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
      'user'=>array(
          # encrypting method (php hash function)
          'hash' => 'md5',

          # send activation email
          'sendActivationMail' => false,

          # allow access for non-activated users
          'loginNotActiv' => false,

          # activate user on registration (only sendActivationMail = false)
          'activeAfterRegister' => true,

          # automatically login from registration
          'autoLogin' => true,

          # registration path
          'registrationUrl' => array('/user/registration'),

          # recovery password path
          'recoveryUrl' => array('/user/recovery'),

          # login form path
          'loginUrl' => array('/user/login'),

          # page after login
          'returnUrl' => array('/user/profile'),

          # page after logout
          'returnLogoutUrl' => array('/user/login'),
            ),
            #...
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
		    'class' => 'WebUser',
		    'allowAutoLogin'=>true,
		    'loginUrl' => array('/user/login'),
		),
		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'excel'=>array(
    	  'class'=>'application.extensions.PHPExcel',
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
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=ams',
			'emulatePrepare' => true,
			'username' => 'ams',
			'password' => 'amsbbtvnewmedia',
			'charset' => 'utf8',
		), */
		
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=ams',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'sql1150',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
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
		'swiftMailer' => array(
			'class' => 'ext.swiftMailer.SwiftMailer',
		)
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);