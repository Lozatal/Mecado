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
        return '
            <div id="accueil"><a href="'.$this->app_root.'/main.php"><img src="'.$this->app_root.'/src/design/css/images/accueil.jpg"/></a></div>';
    }
    
    /* Méthode renderFooter
     *
     * Retourne  le fragment HTML du bas de la page (unique pour toutes les vues)
     */

    private function renderFooter(){
        return '    <footer>
            <div>
                <ul>
                    <li>Partenaire</li>
                    <li>Contact</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li>Publicité</li>
                    <li>Autre truc</li>
                </ul>
            </div>
        </footer>';
    }

    private function renderMenu(){

        $racine =  $this->app_root;

        $v = new \mecadoapp\auth\MecadoAuthentification();
        if($v->logged_in == true)
        {
            $retour = <<<EOT
                <nav>
                    <a href="${racine}/main.php/listes/">Listes</a>
                    <a href="${racine}/main.php/logout/">Deconnexion</a>
                </nav>

EOT;
        }
        else
        {
            $retour = <<<EOT
                <nav>
                    <a href="${racine}/main.php/login/">Connexion</a>
                    <a href="${racine}/main.php/signup/">Inscription</a>
                </nav>

EOT;
        }

        return $retour;
    }
    
    private function renderHome(){  

        $retour = <<<EOT

<section id="home">
            <article>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at purus ut lorem egestas sagittis. Fusce sit amet nisl mauris. Cras eget dolor ut purus varius fermentum. Vestibulum placerat eros neque, sed viverra dui mollis a. Praesent nec enim a eros bibendum luctus. Maecenas vel mattis lectus, non euismod dui. Etiam scelerisque nisl ut auctor finibus. Praesent tempus mollis elit et rutrum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante nisl, id fringilla nulla ultricies sit amet. Nulla molestie nisl quis dui pharetra commodo. In convallis turpis ac consequat rutrum. Donec bibendum non justo auctor malesuada. Nam et egestas nisi, quis imperdiet ex.
            </article>
            <article>
                <ul>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet</li>
                </ul>
            </article>
            <article>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at purus ut lorem egestas sagittis. Fusce sit amet nisl mauris. Cras eget dolor ut purus varius fermentum. Vestibulum placerat eros neque, sed viverra dui mollis a.
            </article>
            <article>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at purus ut lorem egestas sagittis. Fusce sit amet nisl mauris. Cras eget dolor ut purus varius fermentum. Vestibulum placerat eros neque, sed viverra dui mollis a. Praesent nec enim a eros bibendum luctus. Maecenas vel mattis lectus, non euismod dui. Etiam scelerisque nisl ut auctor finibus. Praesent tempus mollis elit et rutrum. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante nisl, id fringilla nulla ultricies sit amet. Nulla molestie nisl quis dui pharetra commodo. In convallis turpis ac consequat rutrum. Donec bibendum non justo auctor malesuada. Nam et egestas nisi, quis imperdiet ex.

    Donec mollis tincidunt ullamcorper. Mauris quis odio consectetur, laoreet metus in, rutrum tellus. Integer suscipit justo non mi pharetra rhoncus. Nullam eget sollicitudin eros. Mauris dictum nisi at dignissim porta. Praesent ullamcorper viverra felis, ac ullamcorper dolor pellentesque ac. Etiam molestie magna magna, ac fermentum elit efficitur non. Fusce convallis ipsum ut erat aliquam suscipit. Fusce quis nulla ligula. Curabitur ac tortor at ex feugiat condimentum nec sed lorem. Proin diam erat, interdum vitae pretium pellentesque, eleifend eget mauris. Quisque posuere neque nibh, placerat consequat orci mattis sed. Aenean sodales, lectus ac feugiat dapibus, nulla tellus aliquam urna, vel imperdiet eros elit ac mauris. Sed sagittis felis vitae velit aliquam vestibulum. Duis libero nulla, suscipit a risus sed, sodales scelerisque urna. 
            </article>
    </section>

EOT;
        return $retour;


    }

    private function renderSignUp() {

        $retour = '
        <section id="sign_up"> 

                <form action="'.$this->app_root.'/main.php/check_signup/" method=post>
                <label for="nom">Nom</label><input type="text" name="nom" placeholder="Nom"/>
                <label for="prenom">Prénom</label><input type="text"  name="prenom" placeholder="Prenom"/>
                <label for="email">Mail</label><input type="text" name="mail" placeholder="Email"/>
                <label for="password">Mot de passe</label><input type="password" name="password"/>
                <label for="password_verify">Confirmation du mot de passe</label><input type="password"  name="password_verify"/><br/>
                <input type="submit" value="S\'inscrire" />
            </form>
        </section>

        ';
        return $retour;

    }

    private function renderLogin() {

        $retour = '
        <section id="login">
            <form action="'.$this->app_root.'/main.php/check_login/" method=post>
                <label for="email">Mail</label><input type="text" name="email" placeholder="Email"/>
                <label for="password">Mot de passe</label><input type="password" name="password" placeholder="Mot de passe"/>
                <input type="submit" value="Connexion" />
            </form>
        </section>

        ';

        return $retour;
    }

    private function renderListe() {

        $retour = '<section id="liste">';

        

        foreach ($this->data as $key => $value) {
            $date = date_create($value->date_limite);
            if(date("Y-m-d H:i:s") >= $value->date_limite)
                $close = 'y';
            else
                $close = 'n';
            $retour = $retour.'
                        <article close="'.$close.'">
                            <p><a href="'.$this->app_root.'/main.php/item.php/?id='.$value->id.'">'.$value->nom.'</a></p>
                            <a href="#">Modifier</a><a href="#">Supprimer</a>
                            <p>Date de l\'évènement: '.date_format($date, 'Y-m-d ').'</p>
                            <p>'.$value->prenom_dest.' '.$value->nom_dest.'</p>
                        </article>
                        ';
        }

        return $retour.'</section>';
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
            case "listes":
                $contenu = $this->renderListe();
                break;
        }

        $racine =  $this->app_root;

        $html = <<<EOT
            <header>
                ${header}
                ${menu}
            </header>

            ${contenu}

            ${footer}

EOT;

        return  $html;
        
    }

}

