<?php
echo "Catalogue :";
echo "<table id='catalogue'><tr><th>Photo</th><th>Référence</th></tr>";

foreach ($donnees as $row ) {
    echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
}

echo "</table>";

echo "<br/><br/>";
//-------------------------------------------------

echo '<form>';
echo'<select width="500" name="Liste_Ref">';
foreach ($test as $test2 ) {

    echo'<option value='.$test2["RefProduit"].'>'.$test2["RefProduit"].'</option>';


}
echo'</select>';
echo'</form>';


echo "<br/><br/>";
echo 'Quantité : ';
echo '<input type="number" name="quantite" size="5" value="1" />';
echo '<p><input type="submit" name="action" value="Ajouter au panier" />';
echo '</form>';
echo "<br/><br/>";


?>
