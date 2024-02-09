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




<div class="main">  	
	<input type="checkbox" id="chk2" aria-hidden="true">
	<div class="formulaire_inscription">
		<form method="POST" action="">
			<label class="maj" for="chk2" aria-hidden="true">Création annonce</label>
			<input type="hidden" name="action" value="creation_annonce">

			<label for="titre_annonce">Titre de l'annonce</label>
			<input type="text" id="titre_annonce" name="titre_annonce" placeholder="Titre de l'annonce Exemple:A Vendre Peugeot 2008" required><br> 
			
			<label for="description">Description</label>
			<br> <br> 
			<textarea id="description" name="description" maxlength=1000 placeholder="Description de l'article Exemple: Véhicule entretenue chez Peugeot. CT vierge... Maximum 1000 lettres" required></textarea>S
			<br><br> <br> 
			<!--<input type="text" name="Date de fin de la publication" min=<?php date('d-m-Y', time()); ?> required> -->
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
			<input type="Number" name="Prix_vente" id="Prix_vente" placeholder="Saisir un chiffre" Min="1" Step="10" Max="1000" required>
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
			<?php prixannonce(); ?>
			</Fieldset>

			<label>Cout total</label>
			<?php prixtotal(); ?>

			$prix_total +




			<p> Vous êtes :</p>
			<input type="radio" id="Homme" name="Sexe" value="1" >  <!-- Mettre le meme nom permet de faire un choix -->
			<label for="Homme"> Homme </label>
			<input type="radio" id="Femme" name="Sexe" value="0">
			<label for="Femme"> Femme </label><br> 
			
			
			<button>Enregistrement</button>
    </form>
	</div>
</div>