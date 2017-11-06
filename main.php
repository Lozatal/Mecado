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
	$router->addRoute('signup',    '/signup/',         '\mecadoapp\control\LoginController', 'signUp', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_signup',    '/check_signup/',         '\mecadoapp\control\LoginController', 'checkSignup', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('login',    '/login/',         '\mecadoapp\control\LoginController', 'login', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_login',    '/check_login/',         '\mecadoapp\control\LoginController', 'checkLogin', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('logout',    '/logout/',         '\mecadoapp\control\LoginController', 'logout', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('listes',    '/listes/',         '\mecadoapp\control\ListeController', 'listes', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('check_liste',    '/check_liste/',         '\mecadoapp\control\ListeController', 'chekListe', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);


	$router->addRoute('default', 'DEFAULT_ROUTE',  '\mecadoapp\control\MecadoController', 'viewHome');

	$router->run();