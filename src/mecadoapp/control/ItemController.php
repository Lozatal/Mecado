<?php

namespace mecadoapp\control;

use mecadoapp\model\Item as item;

class ItemController extends \mf\control\AbstractController {


    /* Constructeur :
     * 
     * Appelle le constructeur parent
     *
     * c.f. la classe \mf\control\AbstractController
     * 
     */
    
    public function __construct(){
        parent::__construct();
    }
    
    //Gère l'affichage des cadeaux de la liste, le premier paramètre correspond au message d'erreur des messages
    public function viewItem($e = null){
    	$get = $this->request->get;
    	
    	$resultat['erreur'] = $e;
    	$resultat['listeItem'] = null;
    	
    	try{
	    	if(isset($get['id'])){
	    		
	    		$util = new \mecadoapp\auth\MecadoAuthentification();
	    		
	    		if (is_null($util->user_login)){
	    			throw new \mf\auth\exception\AuthentificationException("Vous devez être identifié pour accéder à ce lien");
	    		}
	    		
	    		$listeItem = item::where('item.id_liste', '=', $get['id'])
	    		->get();
	    	}
	    	else{
	    		throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste est introuvable");
	    	}
	    	
	    	$resultat['listeItem']= $listeItem;
    	}catch(\mf\auth\exception\AuthentificationException $e){
    		$resultat['erreur'] = $e->getmessage();
    	}
    	
    	$vue = new \mecadoapp\view\MecadoView($resultat);
    	return $vue->render('item');

    	
    }
    public function addItem(){
        $vue = new \mecadoapp\view\MecadoView(null);
        $vue ->render('addItem'); 
    }

}
