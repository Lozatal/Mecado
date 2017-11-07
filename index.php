<!DOCTYPE html>
<html lang="FR">
	<head>
		<title>Mecado.net Vos listes de cadeaux !</title>
		<link rel="stylesheet" href="src/design/css/design.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	<div id="grille">
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
	</div>
		<header>
			<div id="accueil"><a href="#"><img src="src/design/css/images/accueil.jpg"/></a></div>
			<nav>
				<a href="#">Connexion</a>
				<a href="#">Inscription</a>
			</nav>
		</header>

		<!--<section id="home">
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
		</section>-->
		<!--
		<section id="sign_up">
			<article>
				<form>
					<label for="nom">Nom</label><input type='text' name="nom"/>
					<label for="prenom">Prénom</label><input type='text'  name="prenom"/>
					<label for="mail">Mail</label><input type='text' name="mail"/>
					<label for="mdp">Mot de passe</label><input type='password' name="mdp"/>
					<label for="cmdp">Confirmation du mot de passe</label><input type='password'  name="cmdp"/><br/>
					<input type='submit' value="S'inscrire" />
				</form>
			<article>
		</section>-->
		
		<section id="login">
				<form>
					<label for="mail">Mail</label><input type="text" name="mail" placeholder="Entrez votre mail"/>
					<label for="mdp">Mot de passe</label><input type='password' name="mdp" placeholder="Entrez votre mot de passe"/>
					<input type="submit" value="Connexion" />
				</form>
		</section>
		<section id="add_cadeau">
				<form>
					<label for="nom">Nom</label><input type='text' name="nom" placeholder="Entrez un nom"/>
					<label for="lien">Lien image</label><input type='text'  name="lien" placeholder="Entrez le lien d'une image"/>
					<label for="descr">Description</label><textarea name="descr" placeholder="Entrez une description"></textarea>
					<label for="prix">Prix</label><input type='text' name="prix" placeholder="Entrez le prix du cadeau"/>
					<input type="submit" value="Ajouter cadeau" />
				</form>
		</section><!--

		<section id="cadeau">
			<a href="#">Ajouter un cadeau</a>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="src/design/css/images/cado.jpeg"><img src="src/design/css/images/cado.jpeg" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 1</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 2</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 3</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 4</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 5</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 6</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 7</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 8</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 9</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 10</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 11</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 12</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
			<article>
				<div><a href="#">Modifier</a><a href="#">Supprimer</a></div>
				<div>
					<a href="#"><img src="" alt="lien vers le site marchand"/></a>
					<aside><h2>Cadeau 13</h2><p>Prix : 20€</p><p>J'aime vraiment beaucoup ça</p></aside>
				</div>
				<form>
					<label>Nom</label><input type="text"/>
					<label>Message pour XXXXXXX</label><textarea></textarea>
					<input type='submit' value="Réserver" />
				</form>
			</article>
		</section>-->
		<footer>
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
		</footer>
	</body>
</html>
