<?php

// Fonction qui permet de contrôler l'accès à la page en cours
// Fonctionnement des levels sous forme numérique
// A placer avant tout code html
// 0 : visible de tous
// 1 : Membre
// 2 : Modérateur
// 3 : Administrateur

function check_session_level($level){

	// Si la page en question requiert d'être connecté
	if($level>0){

		// On considère qu'on stocke dans la session le level de l'utilisateur connecté

		// On vérifie si un utilisateur est connecté en vérifiant si un level est spécifié dans la session
		if($isset($_SESSION['level'])){
			if($_SESSION['level']<$level){
				header('location:403.php');
			}
		}
		// Sinon, redirection vers la page 403.php
		else{
			header('location:403.php');
		}

	}

}

?>