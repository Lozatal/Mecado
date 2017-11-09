<?php

namespace mecadoapp\control;

use mecadoapp\model\Item as item;
use mecadoapp\model\Liste as liste;
use mecadoapp\model\Acheteur as acheteur;

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
    
    /**
     * Fonction qui va gèrer l'affichage des cadeaux de la liste, le premier paramètre correspond au message d'erreur des messages
     * 
     * @param e = correspond au message d'erreur des messages, vide par défaut
     */
    public function viewItem($e = null){
    	$get = $this->request->get;
    	
    	$resultat['erreur'] = $e;
    	$resultat['listeItem'] = null;
	$resultat['idListe'] = null;
	$resultat['token'] = false;
    	$id=null;
    	try{
		if(isset($get['id'])){
			$id=$get['id'];
		}elseif(isset($get['token'])){
			$obj = liste::select('id')->where('liste.token', '=', $get['token'])->first();
			$id=$obj->id;
			$resultat['token']=true;
		}
		$resultat['idListe']=$id;
	    	if($id!=null){
	    		
	    		$util = new \mecadoapp\auth\MecadoAuthentification();
	    		
	    		if (is_null($util->user_login)){
	    			throw new \mf\auth\exception\AuthentificationException("Vous devez être authentifié pour accéder à ce lien");
	    		}
	    		else{
	    			$liste = liste::where('liste.id', '=', $id)
	    			->first();
	    			//Si la liste n'a pas été trouvé, on retourne une erreur
	    			if(!isset($liste) || $liste->id == null){
	    				throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste est introuvable");
	    			}
	    			
	    			//On va rechercher si l'utilisateur en session est bien le propriétaire de la liste
	    			if($liste->user->mail != $util->user_login){
	    				throw new \mf\auth\exception\AuthentificationException("Vous n'êtes pas le propriétaire de cette liste");
	    			}
	    			
	    			$listeItem = $liste->items;
	    		}
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
    
    /**
     * Fonction qui va appeller l'affichage de l'ajout d'un item
     * 
     * @param e = correspond au message d'erreur des ajouts d'item, vide par défaut
     */
    public function viewAddItem($e=null){
    	try{
    		//Ce paramètre est présent si le checkitem a renvoyé une erreur
    		if (isset($e)){
    			throw new \mf\auth\exception\AuthentificationException($e);
    		}
    		if (!isset($this->request->get['id']) || $this->request->get['id'] == null){
    			throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste est introuvable");
    		}
    		$vue = new \mecadoapp\view\MecadoView(null);
    		$vue ->render('addItem'); 
 
    	}catch(\mf\auth\exception\AuthentificationException $e){
    		$vue = new \mecadoapp\view\MecadoView($e->getmessage());
    		$vue ->render('addItem'); 
    	}
    }

    /**
     * Fonction qui va ajouter un item ou mettre à jour un item éxistant
     */
    public function addItem(){

    	$id_liste = $this->request->post['id_liste'];
        $nom = $this->request->post['nom'];
        $description = $this->request->post['description'];
        $url_article = $this->request->post['url_article'];
        $url_image = $this->request->post['url_image'];
        $tarif = $this->request->post['tarif'];
        
        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {

            $item = new item();
            
            //On va vérifier que la liste éxiste bien
            $liste = liste::where('id', '=', $id_liste)
            ->first();
            
            if(!isset($liste) || $liste->id == null){
            	throw new \mf\auth\exception\AuthentificationException("Le cadeau n'a pas pu être enregistrée à cette liste car l'identifiant de la liste n'a pas été retrouvée");
            }
            
            if (!isset($nom) || $nom == null){
            	throw new \mf\auth\exception\AuthentificationException("Le cadeau doit être renseigné");
            }
            if (!is_int((int)$tarif)){
            	throw new \mf\auth\exception\AuthentificationException("Le tarif doit être un nombre");
            }
            
            $item->nom = $nom;
            $item->description = $description;
            $item->url_article = $url_article;
            $item->url_image = $url_image;
            $item->tarif = $tarif;
            $item->id_liste = $id_liste;
            $item->save();
            $this->viewItem();
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
        	$this->viewAddItem($e->getmessage());
        }

    }
    
    /**
     * Fonction qui va appeller l'affichage de modification d'un item
     *
     * @param e = correspond au message d'erreur des ajouts d'item, vide par défaut
     */
    public function viewUpdateItem($e=null){
    	
    	$resultat['erreur'] = $e;
    	$resultat['item'] = null;
    	
    	try{
    		//Ce paramètre est présent si le checkitem a renvoyé une erreur
    		if (isset($e)){
    			throw new \mf\auth\exception\AuthentificationException($e);
    		}
    		if (!isset($this->request->get['id']) || $this->request->get['id'] == null){
    			throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste est introuvable");
    		}
    		if (!isset($this->request->get['item_id']) || $this->request->get['item_id'] == null){
    			throw new \mf\auth\exception\AuthentificationException("L'identifiant du cadeau à modifier est introuvable");
    		}
    		
    		//On récupère l'item a modifier
    		$item= item::where('id', '=', $this->request->get['item_id'])
    		->first();
    		
    		if (!isset($item) || $item->id == null){
    			throw new \mf\auth\exception\AuthentificationException("Le cadeau a modifié n'a pas été trouvé en base de données");
    		}
    		
    		$resultat['item'] = $item;
    		
    		$vue = new \mecadoapp\view\MecadoView($resultat);
    		$vue ->render('updateItem');
    		
    	}catch(\mf\auth\exception\AuthentificationException $e){
    		$resultat['erreur'] = $e;
    		
    		$vue = new \mecadoapp\view\MecadoView($resultat);
    		$vue ->render('updateItem');
    	}
    }
    
    /**
     * Fonction qui va mettre à jour un item éxistant
     */
    public function updateItem(){
    	
    	
    	$id_item = $this->request->post['id_item'];
    	$id_liste = $this->request->post['id_liste'];
    	$nom = $this->request->post['nom'];
    	$description = $this->request->post['description'];
    	$url_article = $this->request->post['url_article'];
    	$url_image = $this->request->post['url_image'];
    	$tarif = $this->request->post['tarif'];
    	
    	$v = new \mecadoapp\auth\MecadoAuthentification();
    	try {
    		// on vérifie que l'item est présent
    		if(!isset($id_item) || $id_item == null)
    		{
    			throw new \mf\auth\exception\AuthentificationException("L'identifiant du cadeau n'est pas renseigné");
    		}
    		
    		//On récupère l'item
    		$item= item::where('id', '=', $id_item)
    		->first();
    		
    		if(!isset($item) || $item->id == null){
    			throw new \mf\auth\exception\AuthentificationException("Le cadeau n'a pas été retrouvé en base de données, peux-être a t'il déja été supprimé");
    		}
    		
    		//On va vérifier que la liste éxiste bien
    		$liste = liste::where('id', '=', $id_liste)
    		->first();
    		
    		if(!isset($liste) || $liste->id == null){
    			throw new \mf\auth\exception\AuthentificationException("La liste n'a pas été retrouvée en base de données, peux-être a t'elle déja été supprimée");
    		}
    		
    		//On vérifie que la liste et l'item sont bien liés ensemble
    		if($liste->id != $item->id_liste){
    			throw new \mf\auth\exception\AuthentificationException("Le cadeau que vous voulez modifier n'est pas relié à cette liste");
    		}
    		
    		if (!isset($nom) || $nom == null){
    			throw new \mf\auth\exception\AuthentificationException("Le cadeau doit être renseigné");
    		}
    		if (!is_int((int)$tarif)){
    			throw new \mf\auth\exception\AuthentificationException("Le tarif doit être un nombre");
    		}
    		
    		$item->nom = $nom;
    		$item->description = $description;
    		$item->url_article = $url_article;
    		$item->url_image = $url_image;
    		$item->tarif = $tarif;
    		$item->save();
    		$this->viewItem();
    	}
    	catch(\mf\auth\exception\AuthentificationException $e)
    	{
    		$this->viewUpdateItem($e->getmessage());
    	}
    	
    }
    

    /**
     * Fonction qui va réserver un item avec les données de l'acheteur
     */
    public function reservItem(){
    	try{
    		if($this->request->post != null){

    			if(isset($this->request->post['id_item']) && $this->request->post['id_item'] != null){
    				$form=$this->request->post;
    			}
    			else{
    				throw new \mf\auth\exception\AuthentificationException("L'identifiant du cadeau est vide dans le formulaire de réservation");
    			}
    			
    			//on va vérifier que l'item n'est pas déja réservé
    			$item = item::where('id', '=', $form['id_item'])
    			->first();
    			if(isset($item->acheteurs[0]) && $item->acheteurs[0] != null){
    				throw new \mf\auth\exception\AuthentificationException("Le cadeau a déjà été réservé");
    			}
    			
    			$acheteur = new acheteur();
    			$acheteur->nom = $form['nom'];
    			$acheteur->message = $form['message'];
    			$acheteur->id_item = $form['id_item'];
    			$acheteur->save();
    		}
    		
    		$this->viewItem();
    		
    	}catch(\mf\auth\exception\AuthentificationException $e){
    		$this->viewItem($e->getmessage());
    	}
    }
    
    /**
     * Fonction qui va supprimer un item, si l'item a été réservé, on ne le supprime pas
     */
    public function deleteItem(){
    	$get = $this->request->get;
    	
    	try{
    		if(isset($get['id'])){
    			if(isset($get['item_id'])){
    				
    				//D'abord on récupère l'item
    				$item= item::where('item.id', '=', $get['item_id'])
    				->first();
    				
    				if(!isset($item)){
    					throw new \mf\auth\exception\AuthentificationException("L'identifiant du cadeau est introuvable, peux-être a t'il déjà été supprimé");
    				}
    				
    				//On va vérifier si l'id de l'item est bien relié a la liste en cours
    				if($item->id_liste != $get['id']){
    					throw new \mf\auth\exception\AuthentificationException("Le cadeau n'appartient pas à cette liste");
    				}
    				else{
    					//On vérifie que l'item n'est pas été réservé
    					if(isset($item->acheteurs[0]) && $item->acheteurs[0] != null){
    						throw new \mf\auth\exception\AuthentificationException("Le cadeau est réservé, vous ne pouvez pas le supprimer");
    					}
    					else{
    						//C'est bon, on supprime l'item
    						$item->delete();
    					}
    				}
    				
    				$this->viewItem();
    				
    			}
    			else{
    				throw new \mf\auth\exception\AuthentificationException("L'identifiant du cadeau est introuvable");
    			}
    		}
    		else{
    			throw new \mf\auth\exception\AuthentificationException("L'identifiant de la liste est introuvable");
    		}
    	}
    	catch(\mf\auth\exception\AuthentificationException $e){
    		$this->viewItem($e->getmessage());
    	}
    }

}
