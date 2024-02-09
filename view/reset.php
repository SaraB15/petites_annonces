<div class="main">  	
	<input type="checkbox" id="chk" aria-hidden="true">
	<div class="signup">
		<form method="POST" action="">
			<label for="chk" aria-hidden="true">Réinitialisation</label>
			<input type="hidden" name="action" value="reset">
			<input type="hidden" name="token" value="<?=$token?>">
			<input type="password" name="pwd" placeholder="Mot de passe" required="" pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
			<input type="password" name="pwd2" placeholder="Confirmation du mot de passe" required="">
			<button>Réinitialiser</button>
		</form>
	</div>
</div>