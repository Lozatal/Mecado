<?php

namespace mecadoapp\view;

class MecadoView extends \mf\view\AbstractView {
	
	/*
	 * Constructeur
	 *
	 * Appelle le constructeur de la classe \mf\view\AbstractView
	 */
	public function __construct($data) {
		parent::__construct ( $data );
	}
	
	/*
	 * MÃ©thode renderHeader
	 *
	 * Retourne le fragment HTML de l'entÃ©te (unique pour toutes les vues)
	 */
	private function renderHeader() {
		return '
            <div id="accueil"><a href="' . $this->app_root . '/main.php"><img src="' . $this->app_root . '/src/design/css/images/banniere.png"/></a></div>';
	}
	
	/*
	 * Méthode renderFooter
	 *
	 * Retourne le fragment HTML du bas de la page (unique pour toutes les vues)
	 */
	private function renderFooter() {
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
	private function renderMenu() {
		$racine = $this->app_root;
		
		$v = new \mecadoapp\auth\MecadoAuthentification ();
		if ($v->logged_in == true) {
			$retour = <<<EOT
                <nav>
                    <a href="${racine}/main.php/listes/">Listes</a>
                    <a href="${racine}/main.php/logout/">Deconnexion</a>
                </nav>

EOT;
		} else {
			$retour = <<<EOT
                <nav>
                    <a href="${racine}/main.php/login/">Connexion</a>
                    <a href="${racine}/main.php/signup/">Inscription</a>
                </nav>

EOT;
		}
		
		return $retour;
	}
	private function renderHome() {
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
		$alert = '';
		
		if (isset ( $this->data ))
			$alert = '<div class="alerte-danger">' . $this->data . '</div>';
		
		$retour = '
        <section id="sign_up"> 
            <article>
                ' . $alert . '
                <form action="' . $this->app_root . '/main.php/check_signup/" method=post>
                    <label for="nom">Nom</label><input type="text" name="nom" placeholder="Nom" required>
                    <label for="prenom">Prénom</label><input type="text"  name="prenom" placeholder="Prenom" required>
                    <label for="email">Mail</label><input type="text" name="email" placeholder="Email" required>
                    <label for="password">Mot de passe</label><input type="password" name="password" required>
                    <label for="password_verify">Confirmation du mot de passe</label><input type="password"  name="password_verify" required>
                    <input type="submit" value="S\'inscrire" />
                </form>
            </article>
        </section>

        ';
		return $retour;
	}
	private function renderLogin() {
		$alert = '';
		if (isset ( $this->data ))
			$alert = '<div class="alerte-danger">' . $this->data . '</div>';
		
		$retour = '
        <section id="login">
            <article>  
                ' . $alert . '
                <form action="' . $this->app_root . '/main.php/check_login/" method=post>
                    <label for="email">Mail</label><input type="text" name="email" placeholder="Email" required>
                    <label for="password">Mot de passe</label><input type="password" name="password" placeholder="Mot de passe" required>
                    <input type="submit" value="Connexion" />
                </form>
            </article>
        </section>

        ';

        return $retour;
    }

    private function renderListe() {

        $retour = '<section id="liste"><a id="lienAjout" href="'.$this->app_root.'/main.php/add_liste/">Ajouter une liste</a>';     

        foreach ($this->data as $key => $value) {
            $date = date_create($value->date_limite);
            if(date("Y-m-d H:i:s") >= $value->date_limite)
                $close = 'y';
            else
                $close = 'n';
            $retour = $retour.'
                        <article close="'.$close.'">
                            <p><a href="'.$this->app_root.'/main.php/item/?id='.$value->id.'">'.$value->nom.'</a></p>
                            <a class="disabled" href="#"></a><a class="disabled" href="#"></a><a class="disabled" href="#"></a>
                            <p>'.$value->description.'</p>
                            <p>Date de l\'évènement: '.date_format($date, 'Y-m-d ').'</p>
                            <p>'.$value->prenom_dest.' '.$value->nom_dest.'</p>
                        </article>
                        ';
        }

        return $retour.'</section>';
    }

    private function renderAddListe() {

        $racine =  $this->app_root;

        $retour =<<< EOT

        <section id="add_liste">
            <article>
                <form action="${racine}/main.php/check_liste/" method="post">
                    <label for="destinataire">Etes-vous le destinataire : </label><input type="checkbox" name="destinataire" id="destinataire" value="destinataire">
                    <label for="nom">Nom liste</label><input type="text" name="nom" placeholder="nom de liste" required>
                    <label for="description">Description</label><textarea name="description" required></textarea>  
                    <label for="nom_dest">Nom destinataire</label><input type="text" name="nom_dest" placeholder="nom" required>
                    <label for="prenom_dest">Prénom destinataire</label><input type="text" name="prenom_dest" placeholder="prenom" required>
                    <label for="date_limit">Date limite</label><input type="date" name="date_limit" placeholder="date limite" required>
                    <input type="submit" value="Ajouter liste" required>
                </form>
            </article>
        </section>

EOT;
		
		return $retour;
	}
	
	// /////////////// ITEM /////////////////////
	
	// Fonction qui retourne la liste des items et des messages
	private function renderItem() {
		$retour = '';
		
		$get = new \mf\utils\HttpRequest ();
		
		if (isset ( $this->data ['erreur'] ) && $this->data ['erreur'] != null) {
			$retour = '
				<div class="alerte-danger">' . $this->data ['erreur'] . '.</div>';
		}
		
		// Lien pour ajouter un Item
		$retour .= '
				<section id="item">
			<a href="#" id="lienAjout">Ajouter un cadeau</a>';
		
		// Vue des messages
		$retour = $this->afficheMessageItem ( $retour, $this->data ['listeItem'], $get );
		
		// Vue des items
		$retour = $this->afficheListeItem ( $retour, $this->data ['listeItem'], $get );
		
		$retour .= '
			</section>';
		return $retour;
	}
	
	/**
	 * Fonction qui renvoie la vue de la liste des items
	 *
	 * @param retour = retour du HTML
	 * @param dataListeItem = liste des items
	 * 
	 * @retour renvoie le paramètre retour
	 */
	private function afficheListeItem($retour, $dataListeItem) {
		$retour .= '
				<div>';
		
		$destinataire = $dataListeItem [0]->liste->prenom_dest . ' ' . $dataListeItem [0]->liste->nom_dest;
		
		// Puis on affiche la liste des items de la liste
		foreach ( $dataListeItem as $item ) {
			
			$url = '#';
			if (isset ( $item->url_article ) && $item->url_article != null) {
				$url = $item->url_article;
			}
			
			$img = $this->app_root . '/' . 'src/design/css/images/cadeauDefault.png';
			if (isset ( $item->url_image ) && $item->url_image) {
				$img = $item->url_image;
			}
			
			$retour .= '
				<article>
					<div><a href="#"></a><a href="#"></a></div>
					<div>
						<a href="#"><img src="' . $img . '" alt="lien vers le site marchand" ></a>
						<aside><h2>' . $item->nom . '</h2><p>Prix : 20€</p></aside>
					</div>
					<form>
						<label>Nom</label><input type="text"  required>
						<label>Message pour ' . $destinataire . '</label><textarea  required></textarea>
						<input type="submit" value="Réserver" />
					</form>
				</article>';
		}
		
		$retour .= '
				</div>';
		return $retour;
	}
	
	/**
	 * Fonction qui renvoie le code HTML de la partie Message
	 *
	 * @param retour = retour du HTML
	 * @param dataListeItem = liste des items
	 * @param get = contenu du HttpRequest
	 * 
	 * @retour renvoie le paramètre retour
	 */
	private function afficheMessageItem($retour, $dataListeItem, $get) {
		// Ensuite, on gère les messages général de la liste que l'on affiche sur le côté
		$listeMessage = $dataListeItem [0]->liste->messages;
		
		$retour .= '
				<aside>
				';
		
		foreach ( $listeMessage as $message ) {
			$date = date_format ( $message->created_at, 'd:m:Y' );
			$retour .= '
		    		<p>
						<span>' . $date . '-' . $message->auteur . ' :</span>
						 ' . $message->texte . '
					</p>
				';
		}
		
		// formulaire d'ajout de message
		$id = null;
		if (isset ( $get->get ['id'] )) {
			$id = $get->get ['id'];
		}
		$linkformMessage = $this->script_name . "/message_add/?id=" . $id;
		
		$retour .= '
					<form id="addMessage" action="' . $linkformMessage . '" method="POST">
		    			<label for="text">Message:</label><textarea id="text" name="text" required></textarea>
				    	<label for="name">Nom:</label><input type="text" id="nom" name="nom" required>
						<input type="hidden" name="id_liste" id="id_liste" value="' . $id . '" required>
				    	<input type="submit" value="Envoyer">
		    		</form>
				</aside>
		';
		return $retour;
	}
	
	// /////////////// FIN ITEM /////////////////////
	
	protected function renderBody($selector = null) {
		$header = $this->renderHeader ();
		$footer = $this->renderFooter ();
		$menu = $this->renderMenu ();
		
		switch ($selector) {
			case "home" :
				$contenu = $this->renderHome ();
				break;
			case "signUp" :
				$contenu = $this->renderSignUp ();
				break;
			case "login" :
				$contenu = $this->renderLogin ();
				break;
			case "listes" :
				$contenu = $this->renderListe ();
				break;
			case "addListe" :
				$contenu = $this->renderAddListe ();
				break;
			case "item" :
				$contenu = $this->renderItem ();
				break;
		}
		
		$racine = $this->app_root;
		
		$html = <<<EOT
	<div id="wrapper">
            <header>
                ${header}
                ${menu}
            </header>

            ${contenu}

            ${footer}
	</div>
EOT;
		
		return $html;
	}
}

