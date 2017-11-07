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
    
    public function viewItem(){
    	$get=$this->request->get;
    	$listeItem= null;
    	
    	if(isset($get['id'])){
    		$listeItem = item::where('item.id_liste', '=', $get['id'])
    		->get();
    	}
    	
    	$vue = new \mecadoapp\view\MecadoView($listeItem);
    	return $vue->render('item');
    	
    }

}
