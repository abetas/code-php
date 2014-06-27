<?php

function bbcode($chaine)
// remplace les balises BBCode par des balises HTML
{

  $sql = "SELECT * FROM bbcode";
  $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

  while($balises = mysql_fetch_assoc($req)){

    // Première étape, on recrée les balises bbcode et html car elle ne peuvent être stockées en html brut dans le db nous sommes donc obligés d'enlever les caractères spéciaux via un htmlspecialchars
    // La commande explode crée un tableau avec les chaines séparées, nous devons donc veillez à utiliser les indices dans le tableau des chaines afin d'obtenir la bonne partie

    $temp=explode("[", $balises['bbcode']);
    $temp_bbcode=explode("]", $temp[1]);

    $temp=explode("&lt;", $balises['html']);
    $temp_html=explode("&gt;", $temp[1]);

    // Ici, nous avons le contenu qui ira entre les balises

    // Ensuite, on considère deux types de balises, les auto-fermantes (br et hr) et les autres
    // Le champs "autoclose" doit être spécifié lors de la création de la balise bbcode dans le db. Ce champs peut avoir un autre nom

    if($balises['autoclose']){

      // Si les balises sont auto-fermantes alors elles prendront la forme [balise/] en bbcode et <balise/> en html

      $bbcode="[".$temp_bbcode[0]."/]";
      $html="<".$temp_html[0]."/>";

      // Ensuite, on remplace dans la chaine tout ce qui ressemble à la balise bbcode par la balise html. Notez que la chaine est elle aussi stockée dans la db et est donc soumise également à un htmlspecialchars préalable

      $chaine=str_replace($bbcode,$html, $chaine);

    }
    else{

        // Notez le _o pour "ouverture" et le _f pour "fermeture" dans le nom des balises

        $bbcode_o="[".$temp_bbcode[0]."]";
        $html_o="<".$temp_html[0].">";
        $bbcode_f="[/".$temp_bbcode[0]."]";
        $html_f="</".$temp_html[0].">";

        $chaine=str_ireplace($bbcode_o,$html_o, $chaine);
        $chaine=str_ireplace($bbcode_f,$html_f, $chaine);

         // Ensuite, on remplace dans la chaine tout ce qui ressemble à la balise bbcode par la balise html. Notez que la chaine est elle aussi stockée dans la db et est donc soumise également à un htmlspecialchars préalable


      }
    }
  }

  mysql_free_result($req);

  // Ici se placent les balises spéciales (hardcodées selon le même principe)

  return $chaine;

}

?>