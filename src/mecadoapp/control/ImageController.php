<?php

namespace mecadoapp\control;

use mecadoapp\model\Image as image;

class ImageController extends \mf\control\AbstractController {


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

	public function viewImage($e = null){
		$get = $this->request->get;
		if(isset($get['id'])){
			$resultat['images']=image::where('id_item','=',$get['id'])->get();
		}else{
			echo "EXCEPTION";
		}
		$vue = new \mecadoapp\view\MecadoView($resultat);
		return $vue->render('image');
	}

	public function addImage(){

	}

	public function deleteImage(){
	    	$get = $this->request->get;
	    	try{
	    		if(isset($get['id'])){
	    			if(isset($get['item_id'])){
	    				
	    				//D'abord on récupère l'image
	    				$image=image::where('image.id', '=', $get['id'])->first();
	    				
	    				if(!isset($image)){
	    					throw new \mf\auth\exception\AuthentificationException("L'identifiant de l'image est introuvable, peux-être a t'il déjà été supprimé");
	    				}else{
	    					$image->delete();
	    				}
	    				
	    				$this->viewImage();
	    				
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
	    		$this->viewImage($e->getmessage());
	    	}
	}

	public function principaleImage(){

	}
}
