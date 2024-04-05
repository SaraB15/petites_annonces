
<?php
session_start();
$token=htmlspecialchars($_GET['t']);

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message=resetPwd();
		}
		include "view/header.php";

	?>

<div class="main">  	
	<div class="signup">
		<form method="POST" action="">
			<p>Réinitialisation<p>
			<input type="hidden" name="action" value="reset">
			<input type="hidden" name="token" value="<?=$token?>">
			<input type="password" name="pwd" placeholder="Mot de passe" required="" pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
			<input type="password" name="pwd2" placeholder="Confirmation du mot de passe" required="">
			<button>Réinitialiser</button>
		</form>
	</div>
</div>

<?php
include "view/footer.php";
?>