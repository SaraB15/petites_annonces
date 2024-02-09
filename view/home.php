<div class="main">  	
	<div class="home">
		<?php if (!$logged):?>
		<a class="button" href="?p=signup">Créer un compte</a>
		<a class="button" href="?p=signup">Se connecter</a>
		<a class="button" href="?p=creation_annonce">Créer une annonce</a>
		<?php else:?>
		<a class="button" href="?p=deconnect">Se déconnecter</a>
		<?php endif;?>
	</div>
</div>