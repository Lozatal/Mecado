<?php

namespace mecadoapp\control;

use mecadoapp\model\Message as message;
use mecadoapp\model\Liste as liste;

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
    		if($this->request->post != null){
	    		if(isset($this->request->post['id_liste']) && $this->request->post['id_liste'] != null){
		    		$form=$this->request->post;
		    	}
		    	else{
		    		throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste de cadeaux est vide dans le formulaire du message");
		    	}
		    	
		    	$idListe = $this->request->post['id_liste'];
		    	
		    	//Si c'est un token, on va récupérer l'id de la liste
		    	if(isset($this->request->get['token'])){
		    		$idListe = liste::select('id')->where('liste.token', '=', $this->request->post['id_liste'])->first()->id;
		    	}
		    	
	    		$message = new message();
	    		
	    		if($form['nom'] == null){
	    			$form['nom'] = 'non renseigné';
	    		}
	    		if($form['text'] == null){
	    			throw new \mf\auth\exception\AuthentificationException("Le contenu du message est vide");
	    		}
	    		$message->auteur = $form['nom'];
	    		$message->texte = $form['text'];
	    		$message->id_liste = $idListe;
	    		$message->save();
    		}
    		
    		$controleur = new \mecadoapp\control\ItemController();
    		$controleur->viewItem();
    	
    	} catch (\mf\auth\exception\AuthentificationException $e) {
	    	
    		$controleur = new \mecadoapp\control\ItemController();
    		$controleur->viewItem($e->getMessage());
	    }
    }

}
