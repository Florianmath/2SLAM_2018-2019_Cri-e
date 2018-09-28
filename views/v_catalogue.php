<?php	
echo "<div><p>Voici le catalogue à votre disposition :</p><br><br></div>";
echo '<table><TR><TH>Photo</TH><TH>Référence</TH><TH>Désignation</TH><TH>Prix</TH></TR><br/>';
foreach ($donnees as $row ) {

	echo  '<tr><td><img src="'.base_url('Images/').$row['pdt_image'].'.JPG"</img></td><td>'.$row['pdt_ref'].'</td><td>'.$row['pdt_designation'].'</td><td>'.$row['pdt_prix'].'</tr>';
		  
} 
echo '</table>';
echo "<br/><br/>";

echo '<p>';
echo '<form>';
echo "<br/><br/>";
echo 'Réference du produit: ';
echo'<select width="500" name="Liste_Ref">';
foreach ($test as $test2 ) {
	
	echo'<option value='.$test2["pdt_ref"].'>'.$test2["pdt_ref"].'</option>';
} 
echo'</select>';
echo'</form>';
echo '</p>';

echo '<select name="pdt_ref" size="1">';
echo '</select>';
echo '&nbsp&nbsp&nbsp';
echo 'Quantité : ';
echo '<input type="text" name="quantite" size="5" value="1" />';
echo '<p><input type="submit" name="action" value="Ajouter au panier" />';
	/*<form method="post" action="traitement.php">
   <p>
       
       <select name="choix" id="pays">
           <option value="reseau">Reseau</option>
           <option value="developpement">Developpement</option>
       </select>
	   <input type="submit" value="Valider" />
   </p>
	</form>*/

?>