<?

// Contrôle de la validité d'un email
// Synthaxe : nom@domaine.extension
// Extension : minimum 2 caractères, maximum 6
function check_email($adresse)  
{  
   $syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';  
   if(preg_match($syntaxe,$adresse))  
      return true;  
   else  
     return false;  
}

// Contrôle de la validité d'une date
// Prend en comple les mois à 28, 29, 30 ey 31 jours,...
// Sources inconnues
function check_date($date)  
{  
   $syntaxe='#^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$#';  
   if(preg_match($syntaxe,$date))  
      return true;  
   else  
     return false;  
}

// Contrôle d'une heure
// Utile dans le cas d'une heure dans un champs texte
function check_hour($heure){

	$syntaxe="#^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$#";

	if(preg_match($syntaxe,$heure))  
      return true;  
   else  
     return false;  

}

// Contrôle la validité d'un numéro de téléphone
// A Modifier en fonction de l'utilité
function check_phone($phone)  
{  
   $syntaxe='#^[0-9()-]+$#';  
   if(preg_match($syntaxe,$phone))  
      return true;  
   else  
     return false;  
}

// Contrôle la validité d'un nom d'utilisateur entré manuellement
// Nom d'utilisateur en majuscules et minuscules avec les tirets et underscores autorisés
// De 2 à 45 caractères seulement
function check_username($username)  
{  
   $syntaxe='#^([a-zA-Z0-9-_\-]{2,45})$#';  
   if(preg_match($syntaxe,$username))  
      return true;  
   else  
     return false;  
}

?>