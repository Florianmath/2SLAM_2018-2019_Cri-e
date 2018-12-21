<?php
echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix max</th><th>Date Enchere</th><th>Heure debut</th><th>Etat</th></tr>";

foreach ($donnees as $row ) {
	echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['heureDebutEnchere'].'</td><td>'.$row['codeEtat'].'</td></tr><br/>' ;
    //echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
}

echo "</table>";

echo "<br/><br/>";
//-------------------------------------------------

echo '<form>';


echo'<select width="500" name="Liste_Ref">';
foreach ($donnees as $row ) {
	echo'<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
}

echo '<br/><p>Soumettre une offre : </p>';
echo '<input type="number" name="quantite" size="1" value="1" />';
echo '<input type="submit" name="action" value="Soumettre l\'offre" />';

/* foreach ($test as $test2 ) {

    echo'<option value='.$test2["nomEspece"].'>'.$test2["nomEspece"].'</option>';


}
echo'</select>';
echo'</form>';


echo "<br/><br/>";
echo 'Quantité : ';
echo '<input type="number" name="quantite" size="5" value="1" />';
echo '<p><input type="submit" name="action" value="Ajouter au panier" />';
echo '</form>';
echo "<br/><br/>";*/


?>
