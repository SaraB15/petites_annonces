	<?php
session_start();

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message=addUser();
		}
		include "view/header.php";
	?>
	<div class="main">  	

	<div class="formulaire_inscription">
		<form method="POST" action="">
			<p>Enregistrement</p>
			<label for="Nom">Nom</label>
			<input type="text" id="nom" name="nom" placeholder="Nom" value="<?= $_POST["nom"] ?? ""?>"required>
			<label for="Prenom">Prénom</label>
			<input type="text" id="prenom" name="prenom" placeholder="Prenom" value="<?= $_POST["prenom"] ?? ""?>" required>
			<input type="date" name="date_de_naissance" value="<?= $_POST["date_de_naissance"] ?? ""?>" required>
			<p> Vous êtes :</p>
			<input type="radio" id="Homme" name="sexe" value="1" >  <!-- Mettre le meme nom permet de faire un choix -->
			<label for="Homme"> Homme </label>
			<input type="radio" id="Femme" name="sexe" value="0">
			<label for="Femme"> Femme </label><br> 
			<label for="Adresse_postale"> Adresse </label>
			<input type="text" id="adresse_postale" name="adresse_postale" placeholder="Adresse" Maxlength=150 value="<?= $_POST["adresse_postale"] ?? ""?>" required> 
			<label for="code_postale"> Code postale </label>
			<input type="text" id="code_postale" name="code_postale" placeholder="Code postale" value="<?= $_POST["code_postale"] ?? ""?>" required> <!-- pattern="%[\d{5}]%"-->
			<label for="Ville"> Ville </label>
			<input type="text" id="ville" name="ville" placeholder="Ville" value="<?= $_POST["ville"] ?? ""?>" required><br> 
			<label for="N_de_telephone"> Numéro de telephone </label>
			<input type="text" id="n_de_telephone" name="n_de_telephone" placeholder="06 06 06 06 06" value="<?= $_POST["n_de_telephone"] ?? ""?>"  required> <!-- pattern="%[\d{10}]%"-->
			<label for="email"> E-mail </label><br> 
			<input type="email" id="email" name="email" placeholder="Email" value="<?= $_POST["email"] ?? ""?>" required><br> 
			<label for="pwd"> Mot de passe </label>
			<input type="password" id="pwd" name="pwd" placeholder="Mot de passe" required pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
			<input type="password" id="pwd2" name="pwd2" placeholder="Confirmation du mot de passe" required pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
			<button>Enregistrement</button>
			<a href="Connexion.php">Se connecter</a>

			
    </form>
			
		
			
		                         <!-- MP:    12345678Aa@   -->


			
	</div>

	

</div>
<?php
include "view/footer.php";
?>