<div class="main">  	
	<input type="checkbox" id="chk" aria-hidden="true">
	<div class="formulaire_inscription">
		<form method="POST" action="">
			<label class="maj" for="chk" aria-hidden="true">Enregistrement</label>
			<input type="hidden" name="action" value="signup">
			<label for="Nom">Nom</label>
			<input type="text" id="Nom" name="Nom" placeholder="Nom" required>
			<label for="Prenom">Prénom</label>
			<input type="text" id="Prenom" name="Prenom" placeholder="Prenom" required>
			<input type="date" name="Date_de_naissance" required>
			<p> Vous êtes :</p>
			<input type="radio" id="Homme" name="Sexe" value="1" >  <!-- Mettre le meme nom permet de faire un choix -->
			<label for="Homme"> Homme </label>
			<input type="radio" id="Femme" name="Sexe" value="0">
			<label for="Femme"> Femme </label><br> 
			<label for="Adresse_postale"> Adresse </label>
			<input type="text" id="Adresse_postale" name="Adresse_postale" placeholder="Adresse" Maxlength=150 required> 
			<label for="code_postale"> Code postale </label>
			<input type="text" id="code_postale" name="code_postale" placeholder="Code postale"  required> <!-- pattern="%[\d{5}]%"-->
			<label for="Ville"> Ville </label>
			<input type="text" id="Ville" name="Ville" placeholder="Ville" required><br> 
			<label for="N_de_telephone"> Numéro de telephone </label>
			<input type="text" id="N_de_telephone" name="N_de_telephone" placeholder="06 06 06 06 06"  required> <!-- pattern="%[\d{10}]%"-->
			<label for="email"> E-mail </label><br> 
			<input type="email" id="email" name="email" placeholder="Email" required><br> 
			<label for="pwd"> Mot de passe </label>
			<input type="password" id="pwd" name="pwd" placeholder="Mot de passe" required pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
			<input type="password" name="pwd2" placeholder="Confirmation du mot de passe" required>
			<!--<label for="showPassword">Afficher le Mot de Passe :</label>
       		<input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">-->
			<button>Enregistrement</button>
    </form>
			
			<!-- <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var showPasswordCheckbox = document.getElementById('showPassword');

            // Change the input type based on the checkbox state
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        }
    </script>-->
			
		                         <!-- MP:    12345678Aa@   -->
	</div>

	<div class="login" action="">
		<form method="POST">

			<label for="chk" aria-hidden="true">Login</label>
			<input type="hidden" name="action" value="login">
			<input type="email" name="email" placeholder="Email" required="">
			<input type="password" name="pwd" placeholder="Mot de passe" required="">
			<label for="showPassword">Afficher le Mot de Passe :</label>
       		<input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()">  <!-- chatgpt -->
	<!-- <script>

            // Change the input type based on the checkbox state
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        }
    </script>-->
			<button>Login</button>
			<a href="?p=forgot">Mot de passe oublié ?</a>
		</form>
	</div>
</div>