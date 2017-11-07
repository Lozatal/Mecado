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
			<div id="accueil"><a href="#"><img src="src/design/css/images/banniere.png"/></a></div>
			<nav>
				<a href="#">Connexion</a>
				<a href="#">Inscription</a>
			</nav>
		</header>
		<section id="sign_up">
			<article>
				<div class="alerte-danger">Nom d'utilisateur ou mot de passe incorrect.</div>
				<form>
					<label for="nom">Nom</label><input type='text' name="nom"/>
					<label for="prenom">Prénom</label><input type='text'  name="prenom"/>
					<label for="mail">Mail</label><input type='text' name="mail"/>
					<label for="mdp">Mot de passe</label><input type='password' name="mdp"/>
					<label for="cmdp">Confirmation du mot de passe</label><input type='password'  name="cmdp"/><br/>
					<input type='submit' value="S'inscrire" />
				</form>
			</article>
		</section>
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
