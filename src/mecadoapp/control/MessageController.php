<?php

namespace mecadoapp\control;


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

}
