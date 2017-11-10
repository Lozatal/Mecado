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
            <div id="accueil"><a href="' . $this->app_root . '/main.php"><img src="' . $this->app_root . '/src/design/css/images/banniere.png" alt=""></a></div>';
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
                    <li><a href="https://github.com/Texier54/Mecado" title="Lien du github">GitHub</a></li>
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
		$liste=$this->data['liste'];
		$user=$this->data['user'];
		$item=$this->data['item'];
		$racine = $this->app_root;
		$retour = <<<EOT

		<section id="home">
            <article>
				<p>Bienvenue sur Mecado.net ! Le site qui vous permet de gérer vos listes de cadeaux rapidement et sur tout les supports !

					En vous inscrivant gratuitement, vous pouvez créer une liste et l'administrer, que vous soyez celui qui recevras les cadeaux à la fin ou non ! Et si vous faites la liste pour quelqu'un d'autre, des fonctionnalités supplémentaire sont prévue pour vous faciliter la vie !

					N'attendez plus, et venez découvrir tout les secrets de Mecado.net !
					<span>
						Accroche-toi, ferme les yeux, concentre-toi<br>
						Tes bijoux ne valent pas ta présence, tu ouvriras les yeux le jour où...<br>
						Accroche-toi, ferme les yeux, concentre-toi<br>
						Tes bijoux ne valent pas ta présence, tu ouvriras les yeux le jour où...<br>
						<br>
						À quoi me servent tes cadeaux ?<br>
						À quoi me servent tes cadeaux ?<br>
						Tu n'as pas su me soutenir<br>
						Tu n'as pas su me retenir<br>
						À quoi me servent tes cadeaux ?<br>
						À quoi me servent tes cadeaux ?<br>
						Tu n'as pas su me soutenir<br>
						Tu n'as pas su me retenir
					</span>
				</p>
            </article>
			<article>
				<img src="${racine}/src/design/css/images/presentation.png" alt="">
            </article>
            <article>
                <ul>
                    <li>Nombre de liste créée : ${liste}</li>
                    <li>Quantité de cadeau : ${item}</li>
                    <li>Nombre d'utilisateur : ${user}</li>
                </ul>
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
                    <label for="nom">Nom *</label><input type="text" id="nom" name="nom" placeholder="Nom" required>
                    <label for="prenom">Prénom *</label><input type="text" id="prenom" name="prenom" placeholder="Prenom" required>
                    <label for="email">Mail *</label><input type="text" id="email" name="email" placeholder="Email" required>
                    <label for="password">Mot de passe *</label><input type="password" id="password" name="password" required>
                    <label for="password_verify">Confirmation du mot de passe *</label><input type="password" id="password_verify" name="password_verify" required>
                    <input type="submit" value="S\'inscrire" />
                    <p id="obligatoire">Les champs marqué d\'un * sont obligatoire</p>
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
                    <label for="email">Mail</label><input type="text" id="email" name="email" placeholder="Email" required>
                    <label for="password">Mot de passe</label><input type="password" id="password" name="password" placeholder="Mot de passe" required>
                    <input type="submit" value="Connexion" />
                </form>
            </article>
        </section>

        ';

        return $retour;
    }

    private function renderListe() {

        $retour = '<section id="liste"><a id="lienAjout" href="'.$this->app_root.'/main.php/add_liste/" title="Ajouter une liste">Ajouter une liste</a>';

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
                $close = 'close-y';
            else
                $close = 'close-n';
            $retour = $retour.'
                        <article class="'.$close.'">
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
            	$temp = new \DateTime($liste->date_limite);
            	$date_limit = $temp->format('d/m/Y');
            	$text = 'Modifier';
            }
        }

        $alert = '';
		if (isset ( $this->data ))
			$alert = '<div class="alerte-danger">' . $this->data . '</div>';

        $retour =<<< EOT

        <section id="add_liste">
            <article>
            	${alert}
                <form action="${racine}/main.php/check_liste/" method="post">
                	${hidden}
                   	<p>Pour un tier :</p>
                    <input type="radio" id="oui" name="destinataire" value="0" ${checkoui}><label for="oui">Oui</label>
                   	<input type="radio" id="non" name="destinataire" value="1" ${checknon}> <label for="non">Non</label>
                    <label for="nom">Nom liste *</label><input type="text" id="nom" name="nom" placeholder="nom de liste" value="${nom}" required>
                    <label for="description">Description *</label><textarea maxlength="500" id="description" name="description" required>${description}</textarea>  
                    <label for="nom_dest">Nom destinataire</label><input type="text" id="nom_dest" name="nom_dest" placeholder="Si vous n'êtes pas le destinaire" value="${nom_dest}">
                    <label for="prenom_dest">Prénom destinataire</label><input type="text" id="prenom_dest" name="prenom_dest" placeholder="Si vous n'êtes pas le destinaire" value="${prenom_dest}">
                    <label for="date_limit">Date limite *</label><input type="text" id="date_limit" name="date_limit" placeholder="jj/mm/aaaa" value="${date_limit}" required>
                    <input type="submit" value="${text}">
                    <p id="obligatoire">Les champs marqué d'un * sont obligatoire</p>
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
        	$acheteurobj = $requete->get();

			$nom = $value->nom;
			$description = $value->description;
			$url = $value->url_article;
			$img = $value->url_image;
			$tarif = $value->tarif;

			$retour .='

				<article>
					<h2>' . $nom . '</h2>
					<p>' . $description . '</p>';

			foreach ($acheteurobj as $ke => $val) {
					$retour .='<p>'.$val->nom.'</p>
					<p>'.$val->message.'</p>';
			}

			$retour .='</article>';
		
		}	
		return $retour.'</section>';
	}
	//////////////// IMAGE ITEM /////////////////

 	private function renderImage() {
		$idItem=$this->data['id_item'];
		$token = $this->data['token'];
		
		$form='';
		//Gestion Token
		if($token){//Vrai si on arrive par le token
			$idListe = $this->data['idImageToken'];
			$linkformRetour=$this->script_name . "/item/?token=".$idListe;
		}else{
			$idListe=$this->data['idListe'];
			$linkformRetour=$this->script_name . "/item/?id=".$idListe;
			$linkformAddImage=$this->script_name . "/add_image/?id=".$idListe."&id_item=" . $idItem;
			$form=$this->affichageAddImage($linkformAddImage,$idItem);
		}
		$lienRetour='<a id="lienRetour" href="'.$linkformRetour.'">Retour vers la liste</a>';
		//Exception
		echo $this->data ['erreur'];
		
		if (isset ( $this->data ['erreur'] ) && $this->data ['erreur'] != null) {
			$erreur='
				<div class="alerte-'.$this->data ['erreur']['type'].'">' . $this->data ['erreur']['message'] . '.</div>';
		}else{
			$erreur='';
		}

		//Ajout message erreur, du formulaire d'ajout et du lien retour
		$retour='<section id="image">
				'.$erreur.'
				'.$form.'
				'.$lienRetour;
		//Article contenant les images
		foreach ($this->data['images'] as $image) {
			$url=$image->url;
			$id=$image->id;

			$linkformEnregistrer = $this->script_name . "/principale_image/?id_image=".$id."&id_item=".$idItem."&id=".$idListe;
			$linkformSupprimer = $this->script_name . "/delete_image/?id_image=".$id."&id_item=".$idItem."&id=".$idListe;
			if(!$token){
				$lienEnregistrer='<a href="'.$linkformEnregistrer.'" title="Enregistrer en image principale">Image principale</a>';
				$lienSupprimer='<a href="'.$linkformSupprimer.'" title="Supprimer image"></a>';
			}else{
				$lienEnregistrer='';
				$lienSupprimer='';
			}
			$retour.='
				<article>
					'.$lienEnregistrer.'
					'.$lienSupprimer.'
					<img src="'.$url.'" alt="">
				</article>
				';
		}	
		return $retour.'</section>';
	}

 	private function affichageAddImage($link,$id) {
		return $retour='
				<section id="add_image">
					<article>
						<form action="'.$link.'" method="POST">
							<label>Lien vers une image *</label><input type="text" name="url" placeholder="Lien image" required>
							<input type="hidden" name="id" value="'.$id.'">
							<input type="submit">
						</form>
						<p>Les champs marqués de * sont obligatoire.</p>
					</article>
				</section>';
	}
	
	////////////////// ITEM /////////////////////
	
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
		
		$token = $this->data['token'];

		if($token){
			$id = $this->data['idListeToken'];
		}
		else{
			$id = $this->data['idListe'];
		}
		
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
			$retour = $this->afficheMessageItem ( $retour, $this->data ['liste'], $id, $token);
			
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
			
			$url = '';
			if (isset ( $item->url_article ) && $item->url_article != null) {
				$url = $item->url_article;
			}
			
			//image par défault
			$imgPrincipale = $this->app_root . '/' . 'src/design/css/images/cadeauDefault.png';
			
			//On va récupérer l'image principale ou la première
			if(isset($item->images)){
				
				$number = 0;
				foreach($item->images as $image){
					//Dans le cas ou il n'y a pas d'iamge principale, je prends la première par défault, sinon c'est la principale
					if($number == 0 || $image->principale){
						$imgPrincipale = $image->url;
					}
					$number++;
				}
			}
			
			$disabled = '';
			$reserved = 'free';
			
			//Si un acheteur est présent, on verrouille le formulaire
			if(isset($item->acheteurs[0])){
				$disabled = 'disabled';
				$reserved = 'taken';
			}
			
			$linkformReservation = $this->script_name . "/reserv_item/?token=" . $idListe;
			//Si l'utilisateur est le créateur, on affiche les boutons
			$linkModify = $this->script_name . "/view_update_item/?id=". $idListe ."&item_id=" . $item->id;
			$linkDelete = $this->script_name . "/delete_item/?id=". $idListe ."&item_id=" . $item->id;
			$linkImage = $this->script_name . "/image/?token=".$idListe."&id_item=".$item->id;

			$lienSup='';
			$lienMod='';

			$tarif = $item->tarif;
			if($item->cagnotte == 1)
			{
				$reserved='cagnotte';
				$totaltarif = 0;
				foreach ($item->acheteurs()->get() as $key => $value) {
					$totaltarif = $totaltarif + $value->participation;
				}
				$tarif = $totaltarif.' / '.$item->tarif;
				if($totaltarif>=$item->tarif)
					$reserved = 'taken';
			}

			$form='';
			if(!$token){//Vrai si on viens par le token, donc l'utilisateur n'est pas le créateur
				$lienSup='<a href="'.$linkDelete.'" title="Supprimer le cadeau"></a>';
				$lienMod='<a href="'.$linkModify.'" title="Modifier le cadeau"></a>';
				$linkImage = $this->script_name . "/image/?id=".$idListe."&id_item=".$item->id;
			}
			elseif($disabled == null and $item->cagnotte == 0){
				$form='<form id="addMessage" action="' . $linkformReservation. '" method="POST">
						<input name="nom" type="text" placeholder="Nom" required>
						<textarea name="message" placeholder="Message pour ' . $destinataire . '" maxlength="500" required></textarea>
						<input type="hidden" name="id_item" value="' . $item->id. '">
						<input type="submit" value="Réserver">
					</form>';
			}
			elseif($item->cagnotte == 1 and $totaltarif<$item->tarif)
			{
				$reserved = 'cagnotte';
				$form='<p>cagnotte : </p><form id="addMessage" action="' . $linkformReservation. '" method="POST">
						<input name="nom" type="text" placeholder="Nom" required>
						<input name="participation" type="number" step=0.01 required>
						<textarea name="message" placeholder="Message pour ' . $destinataire . '" maxlength="500" required></textarea>
						<input type="hidden" name="id_item" value="' . $item->id. '">
						<input type="submit" value="Réserver" >
					</form>';
			}
			else
			{
				$form = '<p>Réservé par :</p><ul>';
				$acheteur = $item->acheteurs()->get();
				$listeacheteurs = '';
				foreach ($acheteur as $key => $value) {
					$listeacheteurs .= '<li>'.$value->nom.'</li>';
				}
				$form .= $listeacheteurs.'</ul>';
			}
			
			//On récupère le lien de la liste des images de l'item
			
			$lienImage='<a href="'.$linkImage.'" title="Voir toute les images"></a>';

			$retour .= '
				<article class="'.$reserved.'">
					<div>'.$lienImage.$lienMod.$lienSup.'</div>
					<div>
						<a href="'.$url.'"><img src="' . $imgPrincipale. '" alt="lien vers le site marchand"></a>
						<aside><p>' . $tarif . '€</p></aside>
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
	private function afficheMessageItem($retour, $dataListeItem, $idListe, $token) {
		// Ensuite, on gère les messages général de la liste que l'on affiche sur le côté
		
		$retour .= '
				<aside id="message">
					<h2>Messages</h2>
					<div>
				';
		
		if(isset($dataListeItem) && isset($dataListeItem->messages)){
			$listeMessage = $dataListeItem->messages;
			
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
		
		if($token){
			$urlIdListe = 'token='.$idListe;
		}
		else{
			$urlIdListe= 'id='.$idListe;
		}
		
		// formulaire d'ajout de message
		$linkformMessage = $this->script_name . "/message_add/?" . $urlIdListe;
		
		$retour .= '
					<form id="addMessage" action="' . $linkformMessage . '" method="POST">
				    	<label for="message_nom">Nom *</label><input type="text" id="message_nom" name="nom" required>
		    			<label for="message_text">Message *</label><textarea id="message_text" name="text" maxlength="500" required></textarea>
						<input type="hidden" name="id_liste" id="id_liste" value="' . $idListe. '">
				    	<input type="submit" value="Envoyer">
				    	<p id="obligatoire">Les champs marqué d\'un * sont obligatoire</p>
		    		</form>
				</div>
				</aside>
		';
		
		return $retour;
	}

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
                    <label for="nom">Cadeau *</label><input type="text" id="nom" name="nom" placeholder="Objet" required>
                    <label for="description">Description</label><textarea id="description" maxlength="500" name="description"></textarea> 
                    <label for="url_article">Lien de l'article</label><input id="url_article" name="url_article" type="url" placeholder="URL">              
                    <label for="tarif">Tarif *</label><input type="number" id="tarif" name="tarif" placeholder="tarif" step=0.01 required>
                    <p>Cagnotte *</p>
                    	<input type="radio" name="cagnotte" id="oui" value="1"><label for="oui">Oui</label>
                    	<input type="radio" name="cagnotte" id="non" value="0" checked><label for="non">Non</label>
                    <input type="submit" value="Ajouter" ${disabled}>
                    <p id="obligatoire">Les champs marqué d'un * sont obligatoire</p>
                </form>
            </article>
        </section>
EOT;
        return $retour;
    }
    
    private function renderUpdateItem() {
    	
    	$item = $this->data['item'];
    	
    	$retour='';
    	$racine =  $this->app_root;
    	$id = $item->id_liste;
    	$id_item= $item->id;
    	$nom= $item->nom;
    	$description= $item->description;
    	$url_article= $item->url_article;
    	$url_image= $item->url_image;
    	$tarif= $item->tarif;
    	$cagnotte= $item->cagnotte;

    	$checkedoui = '';
    	$checkednon = 'checked';

    	if($cagnotte == 1)
    	{
    		$checkedoui = 'checked';
    		$checkednon = '';
    	}
    	
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
					<label for="tarif">Tarif</label><input type="text" name="tarif" value="${tarif}" placeholder="tarif" required>
					<p>cagnotte</p>
						<input type="radio" name="cagnotte" id="oui" value="1" ${checkedoui}><label for="oui">Oui</label>
						<input type="radio" name="cagnotte" id="non" value="0" ${checkednon}><label for="non">Non</label>
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
			case "image" :
				$contenu = $this->renderImage ();
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

