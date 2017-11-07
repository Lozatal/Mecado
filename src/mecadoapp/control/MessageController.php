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

    //va ajouter un message à la liste et rafraichir la page
    public function addMessage(){
    	
    	try{

    	if(isset($this->request->post['id_liste'])){
    		$form=$this->request->post;
    	}
    	else{
    		throw new Exception("L'identifiant de la liste de cadeaux est vide");
    	}
    	
    	if(isset($form) ){
    		$message = new message();
    		echo $form['nom'];
    		if($form['nom'] == null){
    			throw new Exception("Le nom est vide");
    		}
    		if($form['text'] == null){
    			throw new Exception("Le contenu du message est vide");
    		}
    		$message->auteur = $form['nom'];
    		$message->texte = $form['text'];
    		$message->id_liste = $form['id_liste'];
    		$message->save();
    		
    		$controleur = new \mecadoapp\control\ItemController();
    		$controleur->viewItem();
    	}
    	else{
    		throw new Exception("Le formulaire est vide");
    	}
    	
    	} catch (\mf\auth\exception\AuthentificationException $e) {
	    	
	    	$controleur = new \mecadoapp\control\ItemController();
	    	$controleur->viewItem($e);
	    }
    }

}
