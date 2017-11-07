<?php

	//Démarrage de la session utilisateur
	session_start();
	
	//liste des requires
	require_once('vendor/autoload.php');
	require_once 'src/mf/utils/ClassLoader.php';
	
	//On initie le classLoader
	$loader = new mf\utils\ClassLoader('src');
	$loader->register(); 

	//connexion à la base de donnée
	$config = parse_ini_file('conf/config.ini');

	$db = new Illuminate\Database\Capsule\Manager();

	$db->addConnection($config);
	$db->setAsGlobal();
	$db->bootEloquent();
	
	//On va définir la liste des routes
	$router = new mf\router\Router();

	$router->addRoute('home',    '/home/',         '\mecadoapp\control\MecadoController', 'viewHome', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('signup',    '/signup/',         '\mecadoapp\control\LoginController', 'signUp', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_signup',    '/check_signup/',         '\mecadoapp\control\LoginController', 'checkSignup', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('login',    '/login/',         '\mecadoapp\control\LoginController', 'login', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_login',    '/check_login/',         '\mecadoapp\control\LoginController', 'checkLogin', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('logout',    '/logout/',         '\mecadoapp\control\LoginController', 'logout', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('listes',    '/listes/',         '\mecadoapp\control\ListeController', 'listes', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('check_liste',    '/check_liste/',         '\mecadoapp\control\ListeController', 'chekListe', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);

	//route par défault si jamais l'url est fausse
	$router->addRoute('default', 'DEFAULT_ROUTE',  '\mecadoapp\control\MecadoController', 'viewHome');

	$router->run();