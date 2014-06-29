<?php

// Ici quelques fonctions de recherche
// Deux types de recherche possible
//		La recherche sur base d'information qui renvoi un identifiant
//		La recherche sur base d'identifiant qui renvoi un objet : utilisateur, article, page,...

// Recherche d'un utilisateur sur base d'un username
function search_user_username($username){

	$sql = "SELECT /* ID DU MEMBRE */ FROM /* TABLE */ WHERE /* USERNAME */ LIKE '$username'";
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

    $member = mysql_fetch_array($req);
    mysql_free_result($req);

    if(isset($member[/* ID DU MEMBRE */]))
    	return $member[/* ID DU MEMBRE */];
    else
    	return 0;

}

?>