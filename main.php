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

	$router->addRoute('home','/home/','\mecadoapp\control\MecadoController', 'viewHome', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('signup','/signup/','\mecadoapp\control\LoginController', 'signUp', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_signup','/check_signup/','\mecadoapp\control\LoginController', 'checkSignup', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('login','/login/','\mecadoapp\control\LoginController', 'login', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_login','/check_login/','\mecadoapp\control\LoginController', 'checkLogin', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('logout','/logout/','\mecadoapp\control\LoginController', 'logout', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('listes','/listes/','\mecadoapp\control\ListeController', 'listes', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('check_liste','/check_liste/','\mecadoapp\control\ListeController', 'checkListe', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('supr_liste','/supr_liste/','\mecadoapp\control\ListeController', 'suprListe', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('add_liste','/add_liste/','\mecadoapp\control\ListeController', 'addListe', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('consulte','/consulte/','\mecadoapp\control\ListeController', 'consulte', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);

	$router->addRoute('item','/item/','\mecadoapp\control\ItemController', 'viewItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('view_add_item','/view_add_item/','\mecadoapp\control\ItemController', 'viewAddItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('add_item','/add_item/','\mecadoapp\control\ItemController', 'addItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('view_update_item','/view_update_item/','\mecadoapp\control\ItemController', 'viewUpdateItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('update_item','/update_item/','\mecadoapp\control\ItemController', 'updateItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	$router->addRoute('reserv_item','/reserv_item/','\mecadoapp\control\ItemController', 'reservItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('delete_item','/delete_item/','\mecadoapp\control\ItemController', 'deleteItem', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_USER);
	
	$router->addRoute('message_add','/message_add/','\mecadoapp\control\MessageController', 'addMessage', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);

	$router->addRoute('image','/image/','\mecadoapp\control\ImageController', 'viewImage', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('check_image','/check_image/','\mecadoapp\control\ImageController', 'checkImage', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('delete_image','/delete_image/','\mecadoapp\control\ImageController', 'deleteImage', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);
	$router->addRoute('principale_image','/principale_image/','\mecadoapp\control\ImageController', 'principaleImage', \mecadoapp\auth\MecadoAuthentification::ACCESS_LEVEL_NONE);

	//route par défault si jamais l'url est fausse
	$router->addRoute('default','DEFAULT_ROUTE','\mecadoapp\control\MecadoController', 'viewHome');

	$router->run();
