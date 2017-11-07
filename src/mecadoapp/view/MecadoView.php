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

    /* MÃ©thode renderHeader
     *
     *  Retourne le fragment HTML de l'entÃ©te (unique pour toutes les vues)
     */

    private function renderHeader(){
        return '
            <div id="accueil"><a href="'.$this->app_root.'/main.php"><img src="'.$this->app_root.'/src/design/css/images/accueil.jpg"/></a></div>';
    }
    
    /* MÃ©thode renderFooter
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
                    <li>PublicitÃ©</li>
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
                <label for="prenom">PrÃ©nom</label><input type="text"  name="prenom" placeholder="Prenom"/>
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
            $retour = $retour.'
                        <article close="n">
                            <p>'.$value->nom.'</p>
                            <a href="#">Modifier</a><a href="#">Supprimer</a>
                            <p>Date de l\'évènement: '.date_format($date, 'Y-m-d ').'</p>
                            <p>'.$value->prenom_dest.' '.$value->nom_dest.'</p>
                        </article>
                        ';
        }
        $retour .= <<<EOT
       

EOT;

        return $retour.'</section>';
    }
    
    ///////////////// ITEM /////////////////////
    
    //retourne la liste des items
    private function renderItem() {
    	
    	//Lien pour ajouter un Item
    	$retour = '<section id="item">
			<a href="#" id="lienAjout">Ajouter un cadeau</a>
				<aside>
		';
    	
    	//Ensuite, on gère les messages général de la liste que l'on affiche sur le côté
    	$listeMessage = $this->data[0]->liste->messages;
    	
    	foreach($listeMessage as $message){
    		$date = date_format($message->created_at, 'd:m:Y');
    		$retour .= '
		    		<p>
						<span>'.$date.'-'.$message->auteur.' :</span>
						 '.$message->texte.'
					</p>
				';
    		
    	}
    		
    	$retour .= '
					<form>
		    			<label for="text">Message:</label><textarea name="text"></textarea>
				    	<label for="name">Nom:</label><input type="text" name="nom"/>
				    	<input type="submit" value="Envoyer"/>
		    		</form>
				</aside>
				<div>
		';
    	
    	//Si le créateur est destinataire, on va afficher le nom/prénom du créateur, sinon on récupère les champs non et prenom dans liste
    	$destinataire = '';
    	
    	if (isset($this->data[0]->liste->destinataire) && $this->data[0]->liste->destinataire = 1){
    		$destinataire = $this->data[0]->liste->user->prenom.' '.$this->data[0]->liste->user->nom;
    	}
    	else{
    		$destinataire = $this->data[0]->liste->prenom_dest.' '.$this->data[0]->liste->nom_dest;
    	}
    	
    	//Puis on affiche la liste des items de la liste
    	foreach($this->data as $item){
    		
    		$url = '#';
    		if (isset($item->url_article) && $item->url_article != null){
    			$url = $item->url_article;
    		}
    		
    		$img = $this->app_root.'/'.'src/design/css/images/cadeauDefault.png';
    		if (isset($item->url_image) && $item->url_image){
    			$img = $item->url_image;
    		}
    		
    		$retour .= '
				<article>
					<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
					<div>
						<a href="#"><img src="'.$img.'" alt="lien vers le site marchand" ></a>
						<aside><h2>'.$item->nom.'</h2><p>Prix : 20€</p></aside>
					</div>
					<form>
						<label>Nom</label><input type="text"/>
						<label>Message pour '.$destinataire.'</label><textarea></textarea>
						<input type="submit" value="Réserver" />
					</form>
				</article>
			';
    	}
    	
    	$retour .= '
				</div>
			</section>';
    	
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
            case "listes":
                $contenu = $this->renderListe();
                break;
            case "item":
            	$contenu = $this->renderItem();
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

