

<?php
session_start();

require_once "model/functions.php";

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		$message= ($_POST['action']=='creation_devis')?: addannonce();
		}
		include "view/header.php";
	?>



<body>
<div class="main">  	
	<div class="formulaire_inscription">
		<form method="POST" action="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<p>Création annonce<p>
			<input type="hidden" name="action" value="<?= ($message[1]) ?? 'creation_devis' ?>"> <!-- raccourci echo si le message =2 alors tu mets dans creation annonce : else tu vas dans creation devis -->

			<label for="titre_annonce">Titre de l'annonce</label>
			<input type="text" id="titre_annonce" name="titre_annonce" placeholder="Titre de l'annonce Exemple:A Vendre Peugeot 2008" value="<?= $_POST["titre_annonce"] ?? ""?>" required><br> <!-- si le value permet de garder les données pre remplit en cas denvoi du fichier POST -->
			<br> <br> 
			<label for="categorie">Selectionner la categorie de l'annonce</label>
			<br> <br> 
    		<select id="categorie" name="categorie" required> 
			<option value=1>Immobilier</option>
			<option value=2>Multimédia</option>
			<option value=3>Véhicule</option>
			<option value=4>Objets</option>
			<option value=5>Animaux</option>
			<option value=6>Fashion</option>
			<option value=7>Vente</option>
			<option value=8>Location</option>
			<option value=9>Mode</option>
			</select>

			<br> <br> 
			<label for="description">Description</label>
			<br> <br> 
			<textarea id="description" name="description" maxlength=1000 placeholder="Description de l'article Exemple: Véhicule entretenue chez Peugeot. CT vierge... Maximum 1000 lettres" value="<?= $_POST["description"] ?? ""?>" required></textarea>
			<br><br> <br> 
			
			<label for="nbrs_mois">Selectionner le nombre(s) de mois que vous souhaitez que votre annonce soit visible (maximum 12 mois) :</label>
			<br> <br> 
    		<select id="nbrs_mois" name="nbrs_mois" required> 
			<option value=0>Séléctionnez le nombre de mois</option>
			<option value=1>1 mois</option>
			<option value=2>2 mois</option>
			<option value=3>3 mois</option>
			<option value=4>4 mois</option>
			<option value=5>5 mois</option>
			<option value=6>6 mois</option>
			<option value=7>7 mois</option>
			<option value=8>8 mois</option>
			<option value=9>9 mois</option>
			<option value=10>10 mois</option>
			<option value=11>11 mois</option>
			<option value=12>12 mois</option>
			</select>

			<br><br>
			<label for="date_du_jour">Date début d'annonce : <?= date('Y-m-d') ?></label>
			<br><br>
			
			<label for="date_de_fin">Date fin d'annonce : <span id="date_fin"></span></label>
			<br><br>

			<script>
				document.getElementById("nbrs_mois").addEventListener("change", function() {
					var nombre_mois = parseInt(this.value);
					var dateDebut = new Date();
					var dateFin = new Date(dateDebut);
					dateFin.setMonth(dateFin.getMonth() + nombre_mois);
					document.getElementById("date_fin").textContent = dateFin.getFullYear() + '-' + (dateFin.getMonth() + 1) + '-' + dateFin.getDate();
				});
			</script>

			<label for="prix_vente">Prix de vente</label>
			<input type="Number" name="prix_vente" id="Prix_vente" placeholder="Saisir un chiffre" Min="0" value="<?= $_POST["Prix_vente"] ?? ""?>" required>
			<br><br>
			
			<fieldset> 
				<legend>Tarif de publication</legend>
				<p> 1 à 3 mois : 10 euros/ mois </p>
				<p> 4 à 7 mois : 8 euros/ mois </p>
				<p> 8 à 12 mois : 7 euros/ mois </p>
			</Fieldset>
				<!--<br><button type="button" onclick="addannonce()">Mettre à jour le prix</button><br> -->
			<fieldset> 
				<legend>Prix de l'annonce</legend>
				<p id="prix_annonce">Sélectionnez le nombre de mois que vous souhaitez que votre annonce soit visible (maximum 12 mois).</p>

				<script>
        document.getElementById("nbrs_mois").addEventListener("change", function() {
            var nombre_mois = parseInt(this.value);
            var prix_message = document.getElementById("prix_annonce");

            if (nombre_mois >= 1 && nombre_mois <= 3) {
                prix_message.textContent = "Le prix de l'annonce est de " + (nombre_mois * 10) + " euros.";
            } else if (nombre_mois >= 4 && nombre_mois <= 7) {
                prix_message.textContent = "Le prix de l'annonce est de " + (nombre_mois * 8) + " euros.";
            } else if (nombre_mois >= 8 && nombre_mois <= 12) {
                prix_message.textContent = "Le prix de l'annonce est de " + (nombre_mois * 7) + " euros.";
            } else {
                prix_message.textContent = "Sélectionnez le nombre de mois que vous souhaitez que votre annonce soit visible (maximum 12 mois).";
            }
        });

        document.getElementById("enregistrer").addEventListener("click", function() {
            var prix_vente = document.getElementById("prix_vente").value;
            alert("Prix de vente enregistré : " + prix_vente + " euros.");
        });
    </script>
			
			</Fieldset>
			<button>Enregistrement</button>
    </form>
	</div>
</div>
	</body>




<?php
include "view/footer.php";
?>