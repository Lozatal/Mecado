<?php

	session_start();
	require_once('vendor/autoload.php');


	require_once 'src/mf/utils/ClassLoader.php';
	$loader = new mf\utils\ClassLoader('src');
	$loader->register(); 

	$config = parse_ini_file('conf/config.ini');

	$db = new Illuminate\Database\Capsule\Manager();

	$db->addConnection($config);
	$db->setAsGlobal();
	$db->bootEloquent();

	$router = new mf\router\Router();

	$router->addRoute('home',    '/home/',         '\mecadoapp\control\MecadoController', 'viewHome', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('signup',    '/signup/',         '\mecadoapp\control\MecadoController', 'signUp', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_signup',    '/check_signup/',         '\mecadoapp\control\MecadoController', 'checkSignup', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('login',    '/login/',         '\mecadoapp\control\MecadoController', 'login', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_login',    '/check_login/',         '\mecadoapp\control\MecadoController', 'checkLogin', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('logout',    '/logout/',         '\mecadoapp\control\MecadoController', 'logout', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);


	$router->addRoute('default', 'DEFAULT_ROUTE',  '\mecadoapp\control\MecadoController', 'viewHome');

	$router->run();