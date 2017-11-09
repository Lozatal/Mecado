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
		
		if (isset($this->data))
			$alert = '<div class="alerte-' . $this->data[0] . '">' . $this->data[1] . '</div>';
		
		$retour = '
        <section id="sign_up"> 
            <article>
                ' . $alert . '
                <form action="' . $this->app_root . '/main.php/check_signup/" method=post>
                    <label for="nom">Nom</label><input type="text" name="nom" placeholder="Nom" required>
                    <label for="prenom">Prénom</label><input type="text"  name="prenom" placeholder="Prenom" required>
                    <label for="email">Mail</label><input type="text" name="email" placeholder="Email" min="6" required>
                    <label for="password">Mot de passe</label><input type="password" name="password" min="6" required>
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

        $req = new \mf\utils\HttpRequest();
        if(isset($req->get['url']))
        {
            $requete = \mecadoapp\model\Liste::where('id', '=', $req->get['url']);
            $liste = $requete->first();
        	$retour .= '<div class="alerte-success"><a href="'.$this->app_root.'/main.php/item/?token='.$liste->token.'">'.$this->app_root.'/main.php/item/?token='.$liste->token.'</a></div>';
        }

        foreach ($this->data as $key => $value) {
            $date = date_create($value->date_limite);
            if(date("Y-m-d H:i:s") >= $value->date_limite)
                $close = 'y';
            else
                $close = 'n';
            $retour = $retour.'
                        <article close="'.$close.'">
                            <p><a href="'.$this->app_root.'/main.php/item/?id='.$value->id.'">'.$value->nom.'</a></p>
                            <a href="'.$this->app_root.'/main.php/consulte/?id='.$value->id.'" title="Consulter messages"></a><a href="'.$this->app_root.'/main.php/listes/?url='.$value->id.'" title="Générer URL"></a><a href="'.$this->app_root.'/main.php/add_liste/?id='.$value->id.'" title="Modifier"></a><a href="'.$this->app_root.'/main.php/supr_liste/?id='.$value->id.'" title="Supprimer"></a>
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
        $req = new \mf\utils\HttpRequest();

        $hidden = '';
        $check = '';
       	$nom = '';
        $description = '';
        $nom_dest = '';
        $prenom_dest = '';
        $date_limit = '';
        $text = 'Ajouter';
        $checknon = '';
        $checkoui = 'checked';        

        if(isset($req->get['id']))
        {
            $requete = \mecadoapp\model\Liste::where('id', '=', $req->get['id']);
            $liste = $requete->first();

            $user = new \mecadoapp\auth\MecadoAuthentification();
            $requete = \mecadoapp\model\User::where('mail', '=', $user->user_login);
            $userreq = $requete->first();

            if($liste->id_user == $userreq->id)
            {
            	$hidden = '<input type="hidden" name="id" value="'.$req->get['id'].'">';
            	if($liste->destinataire == 1)
            	{
            		$checknon = 'checked';
            		$checkoui = '';

            	}
            	$nom = $liste->nom;
            	$description = $liste->description;
            	$nom_dest = $liste->nom_dest;
            	$prenom_dest = $liste->prenom_dest;
            	$date_limit = $liste->date_limite;
            	$text = 'Modifier';
            }
        }

        $retour =<<< EOT

        <section id="add_liste">
            <article>
                <form action="${racine}/main.php/check_liste/" method="post">
                	${hidden}
                   	<label for="destinataire">Pour un tier :</label>
                    <input type="radio" id="oui" name="destinataire" value="0" ${checkoui}><label for="oui">Oui</label>
                   	<input type="radio" id="non" name="destinataire" value="1" ${checknon}> <label for="non">Non</label>
                    <label for="nom">Nom liste</label><input type="text" name="nom" placeholder="nom de liste" value="${nom}" required>
                    <label for="description">Description</label><textarea maxlength="500" name="description" required>${description}</textarea>  
                    <label for="nom_dest">Nom destinataire</label><input type="text" name="nom_dest" placeholder="Si vous n'êtes pas le destinaire" value="${nom_dest}">
                    <label for="prenom_dest">Prénom destinataire</label><input type="text" name="prenom_dest" placeholder="Si vous n'êtes pas le destinaire" value="${prenom_dest}">
                    <label for="date_limit">Date limite</label><input type="date" name="date_limit" placeholder="jj/mm/aaaa" value="${date_limit}" required>
                    <input type="submit" value="${text}" required>
                </form>
            </article>
        </section>

EOT;
		
		return $retour;
	}


	private function renderConsulte() {

		$retour = '<section id="consulte">';

		foreach ($this->data as $key => $value) {

        	$requete = \mecadoapp\model\Acheteur::where('id_item', '=', $value->id);
        	$acheteurobj = $requete->first();

			$nom = $value->nom;
			$description = $value->description;
			$url = $value->url_article;
			$img = $value->url_image;
			$tarif = $value->tarif;
			$acheteur = $acheteurobj['nom'];
			$message = $acheteurobj['message'];

			$retour .='

				<article>
					<h2>' . $nom . '</h2>
					<p>' . $description . '</p>
					<p>'.$acheteur.'</p>
					<p>'.$message.'</p>
				</article>
				';
		
		}	

		return $retour.'</section>';
	}
	
	// /////////////// ITEM /////////////////////
	
	/**
	 * Fonction qui retourne la liste des items et des messages
	 * 
	 * @retour renvoie un string contenant le HTML
	 */
	private function renderItem() {
		$retour = '';
		
		$get = new \mf\utils\HttpRequest ();
		
		if (isset ( $this->data ['erreur'] ) && $this->data ['erreur'] != null) {
			$retour = '
				<div class="alerte-danger">' . $this->data ['erreur'] . '.</div>';
		}
		
		$id = $this->data['idListe'];
		$token = $this->data['token'];
		
		// Lien pour ajouter un Item
		$titre = 'Titre non renseigné';
		if(isset($this->data ['liste'])){
			$time = strtotime($this->data ['liste']->date_limite);
			$date = date('d-m-Y',$time);
			//$date = date_format ( $date, 'd:m:Y' );
			$titre = 'Titre : '.$this->data ['liste']->nom.'. Valide jusqu\'au '.$date.'.';
		}
		$ajout='';
		if(!$token){
			$ajout='<a href="'.$this->app_root.'/main.php/view_add_item/?id='.$id.'" id="lienAjout">Ajouter un cadeau</a>';
		}
		$retour .= '
			<section id="item">
				<h2 id="titre">'.$titre.'</h2>
				'.$ajout;

		if(isset($this->data ['listeItem']))
		{
			// Vue des messages
			$retour = $this->afficheMessageItem ( $retour, $this->data ['listeItem'], $id);
			
			// Vue des items
			$retour = $this->afficheListeItem ( $retour, $this->data ['listeItem'], $id,$token);
		}
		
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
	 * @retour renvoie un string contenant le HTML
	 */
	private function afficheListeItem($retour, $dataListeItem, $idListe, $token) {
		$retour .= '
				<div>';
		
		if(isset($dataListeItem [0])){
			$destinataire = $dataListeItem [0]->liste->prenom_dest . ' ' . $dataListeItem [0]->liste->nom_dest;
		}
		
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
			
			$disabled = '';
			$reserved = 'free';
			
			//Si un acheteur est présent, on verrouille le formulaire
			$placeholderNom = 'Nom';
			if(isset($item->acheteurs[0])){
				$disabled = 'disabled';
				$reserved = 'taken';
				$placeholderNom = 'Reservé par : '.$item->acheteurs[0]->nom;
			}
			
			$linkformReservation = $this->script_name . "/reserv_item/?id=" . $idListe;
			
			$lienSup='';
			$lienMod='';
			if(!$token){//Vrai si on viens pas par le token, donc l'utilisateur est le créateur
				//Si l'utilisateur est le créateur, on affiche les boutons
				$linkModify = $this->script_name . "/view_update_item/?id=". $idListe ."&item_id=" . $item->id;
				$lienMod='<a href="'.$linkModify.'" title="Modifier le cadeau"></a>';
				$linkDelete = $this->script_name . "/delete_item/?id=". $idListe ."&item_id=" . $item->id;
				$lienSup='<a href="'.$linkDelete.'" title="Supprimer le cadeau"></a>';
				$form='';
			}
			else{
				$form='<form id="addMessage" action="' . $linkformReservation. '" method="POST">
						<input name="nom" type="text" placeholder="'.$placeholderNom.'" '.$disabled.' required>
						<textarea name="message" placeholder="Message pour ' . $destinataire . '" maxlength="500" '.$disabled.' required></textarea>
						<input type="hidden" name="id_item" value="' . $item->id. '" required>
						<input type="submit" value="Réserver" '.$disabled.' />
					</form>';
			}
			
			//On récupère le lien de la liste des images de l'item
			$linkImage = "#";
			$lienImage='<a href="'.$linkImage.'" title="Voir toute les images"></a>';
			
			
			$retour .= '
				<article reserved="'.$reserved.'">
					<div>'.$lienImage.$lienMod.$lienSup.'</div>
					<div>
						<a href="'.$url.'"><img src="' . $img . '" alt="lien vers le site marchand" ></a>
						<aside><p>' . $item->tarif . '€</p></aside>
						<h2>' . $item->nom . '</h2>
						<p>' . $item->description . '</p>
					</div>
					'.$form.'
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
	 * @retour renvoie un string contenant le HTML
	 */
	private function afficheMessageItem($retour, $dataListeItem, $idListe) {
		// Ensuite, on gère les messages général de la liste que l'on affiche sur le côté
		
		$retour .= '
				<aside id="message">
					<h2>Messages</h2>
					<div>
				';
		
		if(isset($dataListeItem [0])){
			$listeMessage = $dataListeItem [0]->liste->messages;
			
			foreach ( $listeMessage as $message ) {
				$date = date_format ( $message->created_at, 'd/m/y-H:i' );
				$retour .= '
			    		<p>
							<span>' . $date . '-<b>' . $message->auteur . '</b> :</span>
							<span> ' . $message->texte . ' </span>
						</p>
					';
			}
		}
		
		// formulaire d'ajout de message
		$linkformMessage = $this->script_name . "/message_add/?id=" . $idListe;
		
		$retour .= '
					<form id="addMessage" action="' . $linkformMessage . '" method="POST">
				    	<label for="message_nom">Nom:</label><input type="text" id="message_nom" name="nom" required>
		    			<label for="message_text">Message:</label><textarea id="message_text" name="text" maxlength="500" required></textarea>
						<input type="hidden" name="id_liste" id="id_liste" value="' . $idListe. '" required>
				    	<input type="submit" value="Envoyer">
		    		</form>
				</div>
				</aside>
		';
		
		return $retour;
	}
	
	/**
	 * Fonction qui renvoie la vue avec le formulaire d'ajout d'item
	 */
	private function renderAddItem() {
		
		$retour='';
        $racine =  $this->app_root;
        $get = new \mf\utils\HttpRequest ();
        $id = '';
        $id_item= '';
        if(isset($get)){
        	if(isset($get->get['id'])){
        		$id= $get->get['id'];
        	}
        }
        
        //Le seul data possible, c'est le message d'erreur, donc si présent, on affiche un message d'erreur
        $disabled = '';
        if (isset ( $this->data ) && $this->data != null) {
        	$retour = '
				<div class="alerte-danger">' . $this->data . '.</div>';
        	//$disabled = 'disabled';
        }

        $idForLink = 'id='.(string)$id;
        $linkformAddItem = $this->script_name . "/add_item/?" . $idForLink;

        $retour .=<<< EOT

        <section id="add_item">
            <article>
            	<form action="${linkformAddItem}" method="post">
                	<input type="hidden" name="id_liste" value="${id}">
                    <label for="nom">Cadeau</label><input type="nom" name="nom" placeholder="Objet" required>
                    <label for="description">Description</label><textarea maxlength="500" name="description" ></textarea> 
                    <label for="url_article">Lien de l'article</label><input type="text" name="url_article" type="url" placeholder="URL">              
                    <label for="tarif">tarif</label><input type="number" name="tarif" placeholder="tarif" step=0.01 required>
                    <input type="submit" value="Ajouter" ${disabled}>
                </form>
            </article>
        </section>
EOT;
        return $retour;
    }
    
    /**
     * Fonction qui renvoie la vue avec le formulaire de modification d'item
     */
    private function renderUpdateItem() {
    	
    	$retour='';
    	$racine =  $this->app_root;
    	
    	$item = $this->data['item'];
    	$id = $item->id_liste;
    	$id_item= $item->id;
    	$nom= $item->nom;
    	$description= $item->description;
    	$url_article= $item->url_article;
    	$url_image= $item->url_image;
    	$tarif= $item->tarif;
    	
    	//c'est le message d'erreur, donc si présent, on affiche un message d'erreur
    	if (isset ( $this->data['erreur'] ) && $this->data['erreur']!= null) {
    		$retour = '
				<div class="alerte-danger">' . $this->data['erreur']. '.</div>';
    	}
    	
    	$idForLink = 'id='.(string)$id.'&item='.(string)$id_item;
    	$linkformAddItem = $this->script_name . "/update_item/?" . $idForLink;
    	
    	$retour .=<<< EOT
    	
        <section id="add_item">
            <article>
            	<form action="${linkformAddItem}" method="post">
            		<input type="hidden" name="id_item" value="${id_item}">
                	<input type="hidden" name="id_liste" value="${id}">
                    <label for="nom">Cadeau</label><input type="nom" name="nom" placeholder="Objet" value="${nom}" required>
                    <label for="description">Description</label><textarea maxlength="500" name="description" value="${description}" ></textarea>
                    <label for="url_article">Lien de l'article</label><input type="text" name="url_article" value="${url_article}" placeholder="URL">
                    <label for="tarif">tarif</label><input type="text" name="tarif" value="${tarif}" placeholder="tarif" required>
                    <input type="submit" value="Modifier">
                </form>
            </article>
        </section>
EOT;
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
			case "consulte" :
				$contenu = $this->renderConsulte ();
				break;
			case "item" :
				$contenu = $this->renderItem ();
				break;
			case "addItem" :
				$contenu = $this->renderAddItem ();
				break;
			case "updateItem" :
				$contenu = $this->renderUpdateItem ();
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

