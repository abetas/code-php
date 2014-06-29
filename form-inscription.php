<form action="" method="POST">

	<!-- Ce script php permet, en cas d'erreur de saise, de conserver les valeurs correctes entrées par l'utilisateur -->
	<?php
		if(!empty($_POST['username']))
			$value='value="'.$_POST['username'].'"';
		else
			$value="";
	?>

	Nom d'utilisateur <input type="text" name="username" <?php print($value); ?> placeholder="Nom d'utilisateur" required>

	<?php
		if(!empty($_POST['nom']))
			$value='value="'.$_POST['nom'].'"';
		else
			$value="";
	?>

	Nom <input type="text" name="nom" <?php print($value); ?> placeholder="Nom" >


	<?php
		if(!empty($_POST['prenom']))
			$value='value="'.$_POST['prenom'].'"';
		else
			$value="";
	?>

	Prénom <input type="text" name="prenom" <?php print($value); ?> placeholder="Prenom" >

	<?php
		if(!empty($_POST['email1']))
			$value='value="'.$_POST['email1'].'"';
		else
			$value="";
	?>

	Email <input type="email" name="email1" <?php print($value); ?> placeholder="Email" required>

	<?php
		if(!empty($_POST['email2']))
			$value='value="'.$_POST['email2'].'"';
		else
			$value="";
	?>

	Confirmation de l'email <input type="email" name="email2" <?php print($value); ?> placeholder="Email" required>

	<!-- On ne place pas le script php pour les mots de passe bien entendu -->

	Mot de passe <input type="password" name="password1"  placeholder="Mot de passe" required>
	
	Confirmation du mot de passe <input type="password" name="password2" placeholder="Mot de passe" required>

</form>