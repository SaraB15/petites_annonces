<?php

// Connection à la base de données et renvoie l'objet PDO : obligatoire 
function connect() {
    // hôte
    $hostname = 'localhost'; // adresse serveur

    // nom de la base de données
    $dbname = 'petites_annonces';

    // identifiant et mot de passe de connexion à la BDD
    $username = 'root'; // VOIR SUR XAMP comment je suis connectée avec avec l'ordinateur 
    $password = 'root';
    
    // Création du DSN (data source name) en combinant le type de BDD, l'hôte et le nom de la BDD
    $dsn = "mysql:host=$hostname;dbname=$dbname";//verifie que je suis en sql

    // Tentative de connexion avec levée d'une exception en cas de problème
    try{
      echo 'Connexion réussie';
      return new PDO($dsn, $username, $password);
      
    } catch (Exception $e){ // si il ny arrive pas il leve une exception qu on met dans la varible $e 
      echo $e->getMessage(); // affiche un message à la base de donnee
    }
}

// Récupération d'un utilisateur à partir de son email
function getUserByEmail($email) {
    try { // SECURITE A LA BASE DE DONNE QUI LEVE UNE EXCEPTION
        $db = connect();
        $query=$db->prepare('SELECT * FROM Utilisateur WHERE email= :email');
        $query->execute(['email'=>$email]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch(); // renvoi les info de la bases de données
        }
    } catch (Exception $e) { // si pas trouver il envoi un messsage erreur
        echo $e->getMessage();
    } 
    return false;
}   

// Récupération d'un utilisateur à partir d'un token
function getUserByToken($token) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT * FROM Utilisateur WHERE token= :token');
        $query->execute(['token'=>$token]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
}   

// Récupération d'un utilisateur à partir d'un id
function getUserById($id) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT * FROM Utilisateur WHERE id_utilisateur= :id_utilisateur');
        $query->execute(['id_utilisateur'=>$id]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
}

function addUser() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);// FILTRE adresse email, email n'existe pas il a le droit de s'inscrire
    if(!getUserByEmail($email)){
        if ((!isset($_POST['nom'] ))||(!isset($_POST['pwd']))||(!isset($_POST['prenom']))||(!isset($_POST['adresse_postale']))||(!isset($_POST['code_postale']))||(!isset( $_POST['n_de_telephone']))||(!isset( $_POST['date_de_naissance']))||(!isset( $_POST['sexe']))||(!isset( $_POST['ville']))) return array ("error", "tous les champs sont requis enregistrement");
        if ($_POST['pwd']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){
                $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT); // pour hasher mdp
                $nom=htmlspecialchars($_POST['nom']); // enleve tous caractere speciaux
                $token=bin2hex(random_bytes(16)); //creer token, BIN2HEX EN BINAIRE, 16 caracteres
                $prenom=htmlspecialchars($_POST['prenom']);
                $adresse_postale=htmlspecialchars($_POST['adresse_postale']);
                $code_postale=htmlspecialchars($_POST['code_postale']);
               if (preg_match("%[\d{10}]%",$_POST['n_de_telephone'])) $n_de_telephone =$_POST['n_de_telephone'];
                $date_de_naissance=date($_POST['date_de_naissance']);
                $sexe=filter_var(($_POST['sexe']), FILTER_VALIDATE_INT);
                $ville=htmlspecialchars($_POST['ville']);
                try {
                    $db = connect();
                    $query=$db->prepare('INSERT INTO Utilisateur (email, nom, password, token, prenom, adresse_postale, code_postale, n_de_telephone, date_de_naissance, sexe, ville) VALUES (:email, :nom, :pwd, :token, :prenom, :adresse_postale, :code_postale, :n_de_telephone, :date_de_naissance, :sexe, :ville)');
                    $query->execute(['email'=> $email, 'nom'=> $nom , 'pwd'=> $pwd, 'token'=> $token, 'prenom'=> $prenom, 'adresse_postale'=> $adresse_postale,'code_postale'=> $code_postale, 'n_de_telephone'=> $n_de_telephone, 'date_de_naissance'=> $date_de_naissance, 'sexe'=> $sexe,'ville'=> $ville]);
                    if ($query->rowCount()){
                        $content="<p><a href='localhost/authentification?p=activation&t=$token'>Merci de cliquer sur ce lien afin activer votre compte</a></p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );// ENVOI MAIL AVEC INFORMATION
                        mail($email,"Veuillez activer votre compte", $content, $headers);
                        return array("success", "Inscription réussi. Vous allez recevoir un mail pour activer votre compte");
                    }else return array("error", "Problème lors de enregistrement");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else return array("error", "Les 2 saisies de mot de passes doivent être identique.");
    }else return array("error", "Un compte existe déjà pour cet email.");
}

function logUser() {
    
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $user=getUserByEmail($email);
    if($user){
        if(password_verify($_POST['pwd'], $user['password'])){
            if($user['actif']){
                $_SESSION['is_login']=true;
                $_SESSION['is_actif']=$user['actif'];
                $_SESSION['id_utilisateur']=$user['id_utilisateur'];
                return array("success", "Connexion réussie avec l'utilisateur :".$_SESSION['id_utilisateur']);               
            }else return array("error", "Veuillez activer votre compte");
        }else return array("error", "Mauvais identifiants");
    }else return array("error", "Mauvais identifiants");
}

function activUser() {
    $token=htmlspecialchars($_GET['t']);
    $user=getUserByToken($token);
    if($user){
        if(!$user['actif']){
            try {
                $db = connect();
                $query=$db->prepare('UPDATE Utilisateur SET token = NULL, actif = 1 WHERE token= :token');
                    $query->execute(['token'=> $token]);
                    if ($query->rowCount()){
                         return array("success", "Votre compte est activé, vous pouvez vous connecter"); 
                    }else return array("error", "Problème lors de l'activation"); 
            } catch (Exception $e) {
                return array("error",  $e->getMessage());
            }              
        }else return array("error", "Ce compte est déjà actif");
    }else return array("error", "Lien invalide !");
}

function waitReset() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if(getUserByEmail($email)){
        $token=bin2hex(random_bytes(16));
        $perim=time()+1200;
        try {
            $db = connect();
            $query=$db->prepare('UPDATE Utilisateur SET token = :token, perim = :perim WHERE email = :email');
            $query->execute(['email'=> $email, 'perim'=> $perim , 'token'=> $token]);
            if ($query->rowCount()){
                $content="<p><a href='localhost/authentification?p=reset&t=$token'>Merci de cliquer sur ce lien pour réinitialiser votre mot de passe</a></p>";
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=iso-8859-1',
                    'X-Mailer' => 'PHP/' . phpversion()
                );
                mail($email,"Réinitialisation de mot de passe", $content, $headers);
                return array("success", "Vous allez recevoir un mail pour réinitialiser votre mot de passe");
            }else return array("error", "Problème lors du process de réinitialisation");
        } catch (Exception $e) {
            return array("error",  $e->getMessage());
        }
    }else return array("error", "Aucun compte ne correspond à cet email.");
}

function resetPwd() {
    $token=htmlspecialchars($_POST['token']);
    $user=getUserByToken($token);
    if($user && user["perim"]>time()){
        if ($_POST['pwd']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){
                $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                try {
                    $db = connect();
                    $query=$db->prepare('UPDATE Utilisateur SET token = NULL, password = :pwd, actif = 1 WHERE token= :token');
                    $query->execute(['pwd'=> $pwd, 'token'=> $token]);
                    if ($query->rowCount()){
                        $content="<p>Votre mot de passe a été réinitialisé</p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        mail($user['email'],"Réinitialisation de mot de passe", $content, $headers);
                        return array("success", "Votre mot de passe a bien été réinitialisé");
                    }else return array("error", "Problème lors de la réinitialisation");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else return array("error", "Les 2 saisies de mot de passe doivent être identiques.");
    }else return array("error", "Les données ont été corrompues ! Veuillez <a href='?p=forgot'>recommencer</a>");
}

// Récupération d'une annonce

function addannonce() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);// FILTRE adresse email, email n'existe pas il a le droit de s'inscrire
    if(!getUserByEmail($email)){
        if ((!isset($_POST["nom"] ))||(!isset($_POST['pwd']))||(!isset($_POST['prenom']))||(!isset($_POST['adresse_postale']))||(!isset($_POST['code_postale']))||(!isset( $_POST['n_de_telephone']))||(!isset( $_POST['date_de_naissance']))||(!isset( $_POST['sexe']))||(!isset( $_POST['Ville']))) return array ("error", "tous les champs sont requis annonce");
        if ($_POST['pwd']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){
                $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT); // pour hasher mdp
                $nom=htmlspecialchars($_POST['Nom']); // enleve tous caractere speciaux
                $token=bin2hex(random_bytes(16)); //creer token, BIN2HEX EN BINAIRE, 16 caracteres
                $Prenom=htmlspecialchars($_POST['Prenom']);
                $Adresse_postale=htmlspecialchars($_POST['Adresse_postale']);
                $code_postale=htmlspecialchars($_POST['code_postale']);
                $N_de_telephone=preg_match("%[\d{10}]%",$_POST['N_de_telephone']);
                $Date_de_naissance=date($_POST['Date_de_naissance']);
                $Sexe=filter_var(($_POST['Sexe']), FILTER_VALIDATE_INT);
                $Ville=htmlspecialchars($_POST['Ville']);
                try {
                    $db = connect();
                    $query=$db->prepare('INSERT INTO Utilisateur (email, Nom, password, token, Prenom, Adresse_postale, code_postale, N_de_telephone, Date_de_naissance, Sexe, Ville) VALUES (:email, :nom, :pwd, :token, :Prenom, :Adresse_postale, :code_postale, :N_de_telephone, :Date_de_naissance, :Sexe, :Ville)');
                    $query->execute(['email'=> $email, 'Nom'=> $nom , 'pwd'=> $pwd, 'token'=> $token, 'Prenom'=> $Prenom, 'Adresse_postale'=> $Adresse_postale,'code_postale'=> $code_postale, 'N_de_telephone'=> $N_de_telephone, 'Date_de_naissance'=> $Date_de_naissance, 'Sexe'=> $Sexe,'Ville'=> $Ville]);
                    if ($query->rowCount()){
                        $content="<p><a href='localhost/authentification?p=activation&t=$token'>Merci de cliquer sur ce lien afin activer votre compte</a></p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );// ENVOI MAIL AVEC INFORMATION
                        mail($email,"Veuillez activer votre compte", $content, $headers);
                        return array("success", "Inscription réussi. Vous allez recevoir un mail pour activer votre compte");
                    }else return array("error", "Problème lors de enregistrement");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else return array("error", "Les 2 saisies de mot de passes doivent être identique.");
    }else return array("error", "Un compte existe déjà pour cet email.");
}


   
    function prix_annonce() {
        Global $prix_total;
        if (isset($_POST["nbrs_mois"])) {
            $nbrs_mois = $_POST["nbrs_mois"];
   
            if ($nbrs_mois >= 1 && $nbrs_mois <= 3) {
                $prix_total= $nbrs_mois * 10;
            } elseif ($nbrs_mois >= 4 && $nbrs_mois <= 7) {
                $prix_total= $nbrs_mois * 8.5;
            } elseif ($nbrs_mois >= 8 && $nbrs_mois <= 12) {
                $prix_total= $nbrs_mois * 7;
            } else {
                return array("error","Veuillez sélectionner un nombre de mois entre 1 et 12.");
            }
        } else {
            return array("error", "Veuillez sélectionner le nombre de mois d'apparition de l'annonce.");
        } 
        return array("success", "Voici votre devis", $prix_total."euros pour ".$nbrs_mois." mois en ligne. Date de fin de la publication :" .date('d-m-Y', time()) );
    }


   