<?php

namespace mecadoapp\control;

use mecadoapp\model\Message as message;
use mecadoapp\model\Item as item;

class MessageController extends \mf\control\AbstractController {


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
    
    //va ajouter un message à la liste et rafraichir la page
    public function addMessage(){

    	if(isset($this->request->post['id_liste'])){
    		$form=$this->request->post;
    	}
    	else{
    		//exceptions
    	}
    	
    	if(isset($form)){
    		$message = new message();
    		if(is_null($form['nom'])){
    			$form['nom'] = 'non renseigné';
    		}
    		$message->auteur = $form['nom'];
    		$message->texte = $form['text'];
    		$message->id_liste = $form['id_liste'];
    		$message->save();
    		
    		$controleur = new \mecadoapp\control\ItemController();
    		$controleur->viewItem();
    	}
    	
    	
    }

}
