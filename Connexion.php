<?php
session_start();

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message=logUser();
		}
		include "view/header.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
	echo "<a href='index.php'>Aller à l'accueil </a>";

	}
?>	

<div class="main">  	

	<div class="Connexion" action="">
		<form method="POST">

			<p>Login</p>
			<input type="hidden" name="action" value="Connexion">
			<input type="email" name="email" placeholder="Email" required="">
			<input type="password" name="pwd" placeholder="Mot de passe" required="">


			<button>Login</button>
			<a href="signup.php">S'inscrire</a>
            <a href="forgot.php">Mot de passe oublié ?</a>
		</form>
	</div>
</div>


<?php
include "view/footer.php";
?>


