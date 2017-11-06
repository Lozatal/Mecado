<?php

namespace mecadoapp\view;

class MecadoView extends \mf\view\AbstractView {
  
    /* Constructeur 
    *
    * Appelle le constructeur de la classe \mf\view\AbstractView
    */

    public function __construct( $data ){
        parent::__construct($data);
    }

    /* Méthode renderHeader
     *
     *  Retourne le fragment HTML de l'entéte (unique pour toutes les vues)
     */

    private function renderHeader(){
        return '<h1>Titre</h1>';
    }
    
    /* Méthode renderFooter
     *
     * Retourne  le fragment HTML du bas de la page (unique pour toutes les vues)
     */

    private function renderFooter(){
        return 'La super app créée en Licence Pro &copy;2017';
    }

    private function renderMenu(){

        $racine =  $this->app_root;
        $retour = <<<EOT
            <nav></nav>

EOT;

    }
    
    private function renderHome(){  

        $retour = '';
        return $retour;


    }

    private function renderSignUp() {

        $retour = '
        <form class="forms" action="'.$this->app_root.'/main.php/check_signup/" method=post>
            <input class="forms-text" type=text name=nom placeholder="Nom">
            <input class="forms-text" type=text name=prenom placeholder="Prenom">
            <input class="forms-text" type=text name=email placeholder="Email">
            <input class="forms-text" type=password name=password placeholder="password">
            <input class="forms-text" type=password name=password_verify placeholder="retype password">

            <button class="forms-button" name=login_button type="submit">Inscription</button>
        </form> ';
        return $retour;

    }

    private function renderLogin() {

        $retour = '
        <form class="forms" action="'.$this->app_root.'/main.php/check_login/" method=post>
            <input class="forms-text" type=text name=email placeholder="email">
            <input class="forms-text" type=password name=password placeholder="password">
            <button class="forms-button" name=login_button type="submit">Login</button>
        </form>';

        return $retour;
    }
    
    protected function renderBody($selector=null){
      
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        $menu = $this->renderMenu();

        switch ($selector) {
            case "home":
                $contenu = $this->renderHome();
                break;
            case "signUp":
                $contenu = $this->renderSignUp();
                break;
            case "login":
                $contenu = $this->renderLogin();
                break;
        }

        $racine =  $this->app_root;

        $html = <<<EOT
            <header class="theme-backcolor1">
                ${header}
                ${menu}
            </header>

            <section class="theme-backcolor2">
                <article>
                    ${contenu}
                </article>
            </section>


            <footer class="theme-backcolor1">
                ${footer}
            </footer>

EOT;

        return  $html;
        
    }

}

