<!-- <head>
    
<script>
    function updatePrice() {
        var nbrs_mois = document.getElementById("nbrs_mois").value;
        // Mettez à jour la valeur d'un champ caché qui sera soumis avec le formulaire
        document.getElementById("nbrs_mois").value = nbrs_mois;
        
        // Soumettre le formulaire
        document.getElementById("chk2").submit();
    }
</script>
</head> -->

<?php
session_start();

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message=addannonce();
		}
		include "view/header.php";
	?>




<div class="main">  	
	<div class="formulaire_inscription">
		<form method="POST" action="">
			<p>Création annonce<p>
			<input type="hidden" name="action" value="<?= ($message[2]) ? 'creation_annonce': 'creation_devis' ?>"> <!-- raccourci echo si le message =2 alors tu mets dans creation annonce : else tu vas dans creation devis -->

			<label for="titre_annonce">Titre de l'annonce</label>
			<input type="text" id="titre_annonce" name="titre_annonce" placeholder="Titre de l'annonce Exemple:A Vendre Peugeot 2008" value="<?= $_POST["titre_annonce"] ?? ""?>" required><br> <!-- si le value permet de garder les données pre remplit en cas denvoi du fichier POST -->
			
			<label for="description">Description</label>
			<br> <br> 
			<textarea id="description" name="description" maxlength=1000 placeholder="Description de l'article Exemple: Véhicule entretenue chez Peugeot. CT vierge... Maximum 1000 lettres" value="<?= $_POST["description"] ?? ""?>" required></textarea>
			<br><br> <br> 
			
			<label for="nbrs_mois">Selectionner le nombre(s) de mois que vous souhaitez que votre annonce soit visible (maximum 12 mois) :</label>
			<br> <br> 
    		<select id="nbrs_mois" name="nbrs_mois" onchange="prixannonce()" required> 
			<option value="1">1 mois</option>
			<option value="2">2 mois</option>
			<option value="3">3 mois</option>
			<option value="4">4 mois</option>
			<option value="5">5 mois</option>
			<option value="6">6 mois</option>
			<option value="7">7 mois</option>
			<option value="8">8 mois</option>
			<option value="9">9 mois</option>
			<option value="10">10 mois</option>
			<option value="11">11 mois</option>
			<option value="12">12 mois</option>
			</select>

			<br><br>

			<label for="Prix_vente">Prix de vente</label>
			<input type="Number" name="Prix_vente" id="Prix_vente" placeholder="Saisir un chiffre" Min="1" Step="10" Max="1000" value="<?= $_POST["Prix_vente"] ?? ""?>" required>
			<br><br>
			
			<fieldset> 
				<legend>Tarif de publication</legend>
				<p> 1 à 3 mois : 10 euros/ mois </p>
				<p> 4 à 7 mois : 8 euros/ mois </p>
				<p> 8 à 12 mois : 7 euros/ mois </p>
			</Fieldset>
				<br><button type="button" onclick="prixannonce()">Mettre à jour le prix</button><br>
			<fieldset> 
				<legend>Prix de l'annonce</legend>
			<?php echo $message[2]; ?>
			</Fieldset>
			<button>Enregistrement</button>
    </form>
	</div>
</div>




<?php
include "view/footer.php";
?>