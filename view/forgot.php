<div class="main">  	
	<input type="checkbox" id="chk" aria-hidden="true">
	<div class="signup">
		<form method="POST" action="">
			<label for="chk" aria-hidden="true">Réinitialisation de mon mot de passe</label>
			<input type="hidden" name="action" value="forgot">
			<input type="email" name="email" placeholder="Email" required="">
			<button>Renvoyer</button>
			<a href="?p=signup">La mémoire m'est revenue</a>
		</form>
	</div>
</div>