<?php

namespace mecadoapp\control;

use mecadoapp\model\Image as image;
use mecadoapp\model\Item as item;

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
		$resultat['get'] = $this->request->get;
		$resultat['idListe'] = item::where('id_liste','=',$resultat['get']['id'])->first();
		if(isset($resultat['get']['id'])){
			$resultat['images']=image::where('id_item','=',$resultat['get']['id'])->get();
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
    		if(isset($get['id_image'])){
			$image=image::where('id', '=', $get['id_image'])->first();
			$image->delete();
		}
		$this->viewImage();
	}

	public function principaleImage(){
	    	$get = $this->request->get;
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
			
		}
		$this->viewImage();
	}
}
