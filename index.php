<?php
include("tools.php");

enteteTitreHTML("Interrogation de la base films");

?>
<script language="JavaScript">
 function majzone()
 {
   if (document.formulaire.typerech[1].checked)
   document.formulaire.filtre.style.visibility = "visible";
   else {
     document.formulaire.filtre.style.visibility = "hidden";
     document.formulaire.filtre.value = "";
   }
 }
</script>


<form method="get" action="film.php" name="formulaire">
  <input type="radio" name="typerech" value="complete"
	 onchange="majzone();" checked="checked"/>
  Recherche complète
  <br />
  <input type="radio" name="typerech" value="motcle"
	 onchange="majzone();" />
  Recherche par mot-clé
  <br />
  <input type="text" name="filtre" style="visibility:hidden"/>
  <br />
  Nombre de résultats par page
  <select name="maxelt">
    <option>5</option>
    <option>10</option>
    <option>15</option>
    <option>20</option>
  </select>
  <br />
  <br />
  <input type="submit" value="C'est parti !" />
</form>

<?php 
finHTML();
?>
