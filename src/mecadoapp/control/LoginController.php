<?php

namespace mecadoapp\control;


class LoginController extends \mf\control\AbstractController {


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

    public function signUp(){

        $v = new \mecadoapp\view\MecadoView(null);
        $v ->render('signUp');

    }

    public function checkSignup(){

        $nom = $this->request->post['nom'];
        $prenom = $this->request->post['prenom'];
        $email = $this->request->post['email'];
        $pass = $this->request->post['password'];
        $pass_verify = $this->request->post['password_verify'];

        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {
            $v->createUser($nom, $prenom, $email, $pass, $pass_verify);
            $v = new \mecadoapp\view\MecadoView(null);
            $v ->render('home');
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            $this->signUp();
        }

    }

    public function login(){

        $v = new \mecadoapp\view\MecadoView(null);
        $v ->render('login');

    }

    public function checkLogin(){
        
        $email = $this->request->post['email'];
        $password = $this->request->post['password'];

        $v = new \mecadoapp\auth\MecadoAuthentification();
        try {
            $v->login($email, $password);
            $v = new \mecadoapp\view\MecadoView(null);
            $v ->render('home');
        }
        catch(\mf\auth\exception\AuthentificationException $e)
        {
            echo $e->getMessage();
            $this->login();
        }

    }

    public function logout(){
        $v = new \mecadoapp\auth\MecadoAuthentification();
        $v->logout();
    }

}
