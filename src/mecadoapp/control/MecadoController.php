<?php

namespace mecadoapp\control;

use mecadoapp\model\Item as item;
use mecadoapp\model\Liste as liste;
use mecadoapp\model\User as user;

class MecadoController extends \mf\control\AbstractController {
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
	$resultat['liste'] = liste::count();
	$resultat['item'] = item::count();
	$resultat['user'] = user::count();
        $v = new \mecadoapp\view\MecadoView($resultat);
        $v ->render('home');

    }

}
