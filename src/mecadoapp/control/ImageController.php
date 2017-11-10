<?php

namespace mecadoapp\control;

use mecadoapp\model\Image as image;
use mecadoapp\model\Item as item;
use mecadoapp\model\Liste as liste;
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

	public function viewImage($tabAlerte=null){
		$resultat['erreur']=$tabAlerte;
		$resultat['idListe'] = null;
		$resultat['idImageToken'] = null;
		$resultat['token'] = false;
		$get = $this->request->get;
		$resultat['id_item'] = $get['id_item'];
			if(isset($get['id'])){
				$id=$get['id'];
			}elseif(isset($get['token'])){
				$obj = liste::select('id')->where('liste.token', '=', $get['token'])->first();
				$id=$obj->id;
				$resultat['token']=true;
				$resultat['idImageToken'] = $get['token'];
			}
			$resultat['idListe']=$id;
		try{
			//$resultat['idListe'] = item::where('id_liste','=',$resultat['get']['id'])->first();
			if(isset($resultat['id_item'])){
				$resultat['images']=image::where('id_item','=',$resultat['id_item'])->get();
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
			$image->id_item=$post['id'];
			$idItem = item::where('id','=',$post['id'])->first();
			if(!isset($idItem) || $idItem->id == null){
				throw new exception("Identifiant du cadeau introuvable");
			}else{
				$tabAlerte['message']="L'image a bien été envoyé";
				$tabAlerte['type']="success";
				$image->save();
				$this->viewImage($tabAlerte);
			}
		}catch(exception $e){
			$tabAlerte['message']=$e->getmessage();
			$tabAlerte['type']="danger";
			$this->viewImage($tabAlerte);
		}
		
	}

	public function deleteImage(){
	    $get = $this->request->get;
		try{
	    	if(isset($get['id_image'])){
				$image=image::where('id', '=', $get['id_image'])->first();
				$image->delete();
				$tabAlerte['message']="L'image a bien été supprimé";
				$tabAlerte['type']="success";
				$this->viewImage($tabAlerte);
			}else{
				throw new exception("Identifiant de l'image introuvable");
			}
		}catch(exception $e){
			$tabAlerte['message']=$e->getmessage();
			$tabAlerte['type']="danger";
			$this->viewImage($tabAlerte);
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
				$tabAlerte['message']="L'image à bien été mise en principale";
				$tabAlerte['type']="success";
				$this->viewImage($tabAlerte);
			}else{
				throw new exception("Idendifiant de l'image ou du cadeau introuvable");
			}
		}catch(exception $e){
			$tabAlerte['message']=$e->getmessage();
			$tabAlerte['type']="success";
			$this->viewImage($tabAlerte);
		}
	}
}
