
<?php
session_start();

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message=waitReset();
		}
		include "view/header.php";
	?>



<div class="main">  	
	<div class="Connexion">
		<form method="POST" action="">
			<p>Réinitialisation de mon mot de passe</p>
			<input type="hidden" name="action" value="forgot">
			<input type="email" name="email" placeholder="Email" required="">
			<button>Renvoyer</button>
			<a href="Connexion.php">La mémoire m'est revenue</a>
		</form>
	</div>
</div>



<?php
include "view/footer.php";
?>