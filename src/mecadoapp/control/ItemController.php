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
    
    public function viewHome(){

        $v = new \mecadoapp\view\MecadoView(null);
        $v ->render('home');

    }
    
    //Gère l'affichage des cadeaux de la liste, le premier paramètre correspond au message d'erreur des messages
    public function viewItem($e = null){
    	$get = $this->request->get;
    	
    	$resultat['erreur'] = $e;
    	$resultat['listeItem'] = null;
    	
    	if(isset($get['id'])){
    		$listeItem = item::where('item.id_liste', '=', $get['id'])
    		->get();
    	}
    	
    	$resultat['listeItem']= $listeItem;
    	
    	$vue = new \mecadoapp\view\MecadoView($resultat);
    	return $vue->render('item');
    	
    }

}
