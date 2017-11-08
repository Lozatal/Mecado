<?php

namespace mecadoapp\control;

use mecadoapp\model\Message as message;

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

    		if(isset($this->request->post['id_liste']) && $this->request->post['id_liste'] != null){
	    		$form=$this->request->post;
	    	}
	    	else{
	    		throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste de cadeaux est vide dans le formulaire du message");
	    	}
	    	
	    	if(isset($form) ){
	    		$message = new message();
	    		
	    		if($form['nom'] == null){
	    			$form['nom'] = 'non renseigné';
	    		}
	    		if($form['text'] == null){
	    			throw new \mf\auth\exception\AuthentificationException("Le contenu du message est vide");
	    		}
	    		$message->auteur = $form['nom'];
	    		$message->texte = $form['text'];
	    		$message->id_liste = $form['id_liste'];
	    		$message->save();
	    		
	    		$controleur = new \mecadoapp\control\ItemController();
	    		$controleur->viewItem();
	    	}
	    	else{
	    		throw new \mf\auth\exception\AuthentificationException("Le formulaire est vide");
	    	}
    	
    	} catch (\mf\auth\exception\AuthentificationException $e) {
	    	
    		$controleur = new \mecadoapp\control\ItemController();
    		$controleur->viewItem($e->getMessage());
	    }
    }

}
