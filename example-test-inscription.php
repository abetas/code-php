<?php

// Ce script est un exemple d'une inscription d'un utilisateur : Formulaire simple (nom d'utilisateur, nom, prenom email et mot de passe)
// Les vérifications et la mannière de tester les variables et d'informer l'utilisateur
// On condière que le formulaire se trouve dans un dossier séparé et qu'on l'ulise via un "include"

	// Ce champs sera un champs caché qui signifiera qu'on a rempli le formulaire et qu'on l'a soumis
	if(isset($_POST['inscription'])){

		// On effectue une vérification en PHP afin de vérifier que tout ce qui est REQUIS est entré, on continue si c'est le cas
		if(!empty($_POST['username']) and !empty($_POST['email1']) and !empty($_POST['email2']) and !empty($_POST['password1']) and !empty($_POST['password2'])){

			// On échappe les caractères spéciaux via des htmlspecialchars ! Attention, l'encodage par défaut diffère en fonction des versions de php, dans le doute, spécifiez toujours l'encodage dans vos htmlspecialchars, le EN_QUOTES permet d'éviter les "" et les ''

			$username=htmlspecialchars($_POST['username'],ENT_QUOTES,'ISO-8859-1');
			$email1=htmlspecialchars($_POST['email1'],ENT_QUOTES,'ISO-8859-1');
			$email2=htmlspecialchars($_POST['email2'],ENT_QUOTES,'ISO-8859-1');

			// On ne fait pas ca pour les mots de passe car ils seront hachés donc innoffensifs pour la db
			// Pour les données faculatives, on vérifie si elles sont introduites avant de les tester
			// Pour les chaines de caractères, on utilise la fonction empty() au lieu du isset()

			if(!empty($_POST['nom']))
				$nom=htmlspecialchars($_POST['nom'],ENT_QUOTES,'ISO-8859-1');
			if(!empty($_POST['prenom']))
				$nom=htmlspecialchars($_POST['prenom'],ENT_QUOTES,'ISO-8859-1');

			// Maintenant on passe à la phase de test des valeurs entrées
			// Prendre en compte les limites de la db et les validation des données (email par exemple)
			// On utilisateur un tableau qui reprendra toutes les erreurs possibles afin d'afficher un ensemble de messages d'erreur à l'utilisateur une fois la vérification terminée

			// Si un utilisateur existe déjà
			if(search_user_username($username)){
				$erreurs[0]=1;
				unset($_POST['username']);
			}
			else{
				// Si le username est trop grand
				if(strlen($username)>/*TAILLE USERNAME*/){
					$erreur[1]=1;
					unset($_POST['username']);
				}
				// Si la synthaxe ne correspond pas
				if(!check_username($username)){
					$erreurs[2]=1;
					unset($_POST['username']);
				}
			}

			// Si l'email n'est pas valide
			if(!check_email($email1)){
				$erreur[3]=1;
				unset($_POST['email1']);
				unset($_POST['email2']);
			}
			// Si il est valide
			else{
				// Si les emails ne correspondent pas
				if(strcmp($email1,$email2)!=0){
					$erreur[4]=1;
					unset($_POST['email1']);
					unset($_POST['email2']);	
				}
			}

			// Si le mot de passe n'est pas valide
			if(!check_password($_POST['password1'])){
				$erreur[5]=1;
				unset($_POST['password1']);
				unset($_POST['password2']);
			}
			// Si il est valide
			else{
				// Si les mots de passe ne correspondent pas
				if(strcmp($password1,$password2)!=0){
					$erreur[6]=1;
					unset($_POST['password1']);
					unset($_POST['password2']);	
				}
				// Si ils correspondent
				else{
					/* FONCTION DE CRYPTAGE ICI ! qui donnera lieu à la variable $password */
				}
			}

			// A noter que d'autres tests peuvent être effectués, ceci n'est qu'un exemple.
			// On peut aussi tester la taille des emails !!
			// Maintenant nous allons tester les données faculatives

			if(isset($nom)){
				if(strlen($nom)>/*TAILLE USERNAME*/){
					$erreur[7]=1;
					unset($_POST['nom']);
				}
			}

			if($isset($prenom)){
				if(strlen($prenom)>/*TAILLE USERNAME*/){
					$erreur[8]=1;
					unset($_POST['prenom']);
				}
			}

			// A ce stade, toutes les données doivent être tester, sur les grops formulaires, plus de 20 paramètres peuvent être testés et DOIVENT l'être ne php car c'est le code qui s'exécute coté serveur et est donc NON MODIFIABLE par le client

			// Au cas ou le tableau des erreurs et set, donc rempli, on affiche les messages correspondants aux codes dans le tableau
			if(isset($erreurs)){
			    $message="";
			    if(isset($erreurs[0]))
			        $message=$message."Cet utilisateur existe déja <br/>";
			    if(isset($erreurs[1]))
			        $message=$message."La taille du nom d'utilisateur est trop grande <br/>";
			    if(isset($erreurs[2]))
			        $message=$message."Veuillez n'utiliser que des caractères alphanumériques pour le nom d'utilisateur <br/>";
			    if(isset($erreurs[3]))
			        $message=$message."Le format de l'email doit être sous la forme nom@domaine.com <br/>";
			    if(isset($erreurs[4]))
			        $message=$message."Les emails ne correspondent !<br/>";
			    if(isset($erreurs[5]))
			        $message=$message."Le mot de passe ne rempli pas les critères de sécurité <br/>";
			    if(isset($erreurs[6]))
			        $message=$message."Les mots de passe ne correspondent pas<br/>";
			    if(isset($erreurs[7]))
			        $message=$message."Nom trop grand<br/>";
			    if(isset($erreurs[8]))
			        $message=$message."Prénom trop grand<br/>";

			    // Affichage du message d'erreur et du formulaire sans les données erronées !
			    print($message);
			    include('forms/add-member-form.php');
			}

			// Sinon, toutes les données sont valides, on passe à l'ajout dans la db
			else{

				// Il s'agit d'une inscription ! Certains champs devront être spécifiés et certains champs seront initialisés par défaut dans le SGBD !

				$sql="INSERT INTO /* TABLE */ (`username`, `email`, `password`) VALUES ('$username', '$email1', '$password')";
		        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

		        // Ajout des informations facultatives
		        // Utilisation du nom d'utilisatuer unique validé précédement

		        if(isset($nom)){
		        	$sql = "UPDATE /* TABLE */ SET nom = '$nom' WHERE username LIKE '".$username."';";
				    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		        }

		        if(isset($prenom)){
		        	$sql = "UPDATE /* TABLE */ SET prenom = '$prenom' WHERE username LIKE '".$username."';";
				    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
		        }

		        // Tout s'est bien déroulé, message de confirmation et procédure d'envoi du mail de confirmation et génération des profils, clés d'activation,...

		        print("Votre demande d'inscription est confirmée ! Veuillez vérifier vos email !");

			}


		}

		// Si toutes les données requises, on affiche à nouveau le formulaire en affichant le message d'erreur
		else{
			echo'<p>Veuillez remplir les champs marqués d\' un * svp !';
			include('form-inscription.php');
		}

	}

	// Sinon, il s'agit de la première visite de la page, donc on affiche le formulaire et le texte informatif
	else{

		echo'<p>Veuillez vous inscrire en remplissant le formulaire ci-dessous</p><hr/>';
		include('form-inscription.php');

	}

?>