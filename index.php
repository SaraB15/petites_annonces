<?php
session_start();
require_once "model/functions.php";


$p= $_GET['p'] ?? ""; // parametre URL p

if($_SERVER["REQUEST_METHOD"] === "POST"){
	$action= $_POST['action'] ?? "";
	switch ($action){
		case 'signup':
			$message=addUser();
			break;
		case 'creation_annonce':
			$message=addannonce();
			break;
		case 'login':
			$message=logUser();
			$p="home";
			break;
		case 'forgot':
			$message=waitReset();
			$p="home";
			break;
		case 'reset':
			$message=resetPwd();
			$p="signup";
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

$logged = $_SESSION['is_login'] ?? false;

include "view/header.php"; // AU DE PAGE HTML
switch ($p) {
	case 'forgot':
		include "view/forgot.php";	
		break;	
	case 'reset':
		$token=htmlspecialchars($_GET['t']);
		include "view/reset.php";	
		break;	
	case 'signup':
		include "view/signup.php";	
		break;
	case 'creation_annonce':
		include "view/creation_annonce.php";	
		break;
	default:
		include "view/home.php";	
}
include "view/footer.php";