<?php

namespace mecadoapp\control;

use mecadoapp\model\Image as image;
use mecadoapp\model\Item as item;
use \mf\auth\exception\AuthentificationException as exception;

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
		try{
			$resultat['get'] = $this->request->get;
			$resultat['idListe'] = item::where('id_liste','=',$resultat['get']['id'])->first();
			if(isset($resultat['get']['id'])){
				$resultat['images']=image::where('id_item','=',$resultat['get']['id'])->get();
			}else{
				throw new exception("L'identifiant du cadeau est introuvable");
			}
		}catch(exception $e){
			$resultat['erreur'] = $e->getmessage();
		}
		$vue = new \mecadoapp\view\MecadoView($resultat);
		return $vue->render('image');
	}

	public function addImage(){
		try{
			$post=$this->request->post;
			$image = new image();
			$image->url=$post['url'];
			$image->id_item=$post['id_item'];
			$idItem = item::where('id','=',$post['id_item'])->first();
			if(!isset($idItem) || $idItem->id == null){
				throw new exception("Identifiant du cadeau introuvable");
			}else{
				$image->save();
				$this->viewImage();
			}
		}catch(exception $e){
			$this->viewImage($e);
		}
		
	}

	public function deleteImage(){
	    	$get = $this->request->get;
		try{
	    		if(isset($get['id_image'])){
				$image=image::where('id', '=', $get['id_image'])->first();
				$image->delete();
				$this->viewImage();
			}else{
				throw new exception("Identifiant de l'image introuvable");
			}
		}catch(exception $e){
			$this->viewImage($e);
		}
	}

	public function principaleImage(){
	    	$get = $this->request->get;
		try{
	    		if(isset($get['id_image']) && isset($get['id'])){
				$listeImage=image::where('id_item', '=', $get['id'])->get();
				foreach($listeImage as $image){
					if($image->id==$get['id_image']){
						$image->principale=1;
						$image->save();
					}else{
						$image->principale=0;
						$image->save();
					}
				}
				$this->viewImage();
			}else{
				throw new exception("Idendifiant de l'image ou du cadeau introuvable");
			}
		}catch(exception $e){
			$this->viewImage($e);
		}
	}
}
