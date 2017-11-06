<?php

	session_start();
	require_once('vendor/autoload.php');


	require_once 'src/mf/utils/ClassLoader.php';
	$loader = new mf\utils\ClassLoader('src');
	$loader->register(); 

	$config = parse_ini_file('conf/config.ini');

	$db = new Illuminate\Database\Capsule\Manager();

	$db->addConnection( $config );
	$db->setAsGlobal();
	$db->bootEloquent();




	  $router = new mf\router\Router();



	$router->addRoute('home',    '/home/',         '\mecadoapp\control\MecadoController', 'viewHome', \tweeterapp\auth\TweeterAuthentification::ACCESS_LEVEL_NONE);


	$router->addRoute('default', 'DEFAULT_ROUTE',  '\mecadoapp\control\MecadoController', 'viewHome');

	$router->run();