<?php

session_start();

require_once "model/functions.php";

include "view/header.php"; // AU DE PAGE HTML

$p= $_GET['p'] ?? ""; // parametre URL p
if($_SERVER["REQUEST_METHOD"] === "POST"){
	$action= $_POST['action'] ?? "";
	switch ($action){
		case 'login':
			$message=logUser();
			$p="home";
			break;
		case 'creation_devis':
			$message= prix_annonce();
			
	}
}

if ($p=='activation')
		$message=activUser(); 

if ($p=='deconnect'){
	session_unset();
	session_destroy();
	$message=array("success", "Vous êtes déconnecté"); 
}
if ($p=='reset' && !isset($_GET['t'])){
	$message=array("error", "Lien invalide. Veuillez réessayer");
	$p="forgot"; // t c'est notre token
}

$logged = (!empty($_SESSION['is_login']));



?>

<div class="main">  	
	<div class="home">
		<?php if (!$logged):?>
		<a class="button" href="signup.php">Créer un compte</a>
		<a class="button" href="Connexion.php">Se connecter</a>
		<?php else:?>
		<?php echo "Bienvenue ".$_SESSION['nom']." ".$_SESSION['prenom'];?>
		
		
		<a class="button" href="creation_annonce.php">Créer une annonce</a>
		<a class="button" href="?p=deconnect">Se déconnecter</a>
		<?php endif;?>
	</div>
</div>
	

<?php

include "view/footer.php";

?>