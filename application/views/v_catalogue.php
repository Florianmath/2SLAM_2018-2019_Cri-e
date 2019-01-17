<?php

//-----------------------Non connecté--------------------------

// ---- Mise en place de la première table ---- // 

if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
{
echo "<br/>Enchères en cours : <br/>";

echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix actuel</th><th>Prix max</th><th>Date heure début</th><th>date heure fin</th><th>Etat</th><th> Acheteur actuel : </th><th> Nombre de jours du lot ... </th></tr>";

foreach ($donnees as $row ) {
	echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td><td>.'.$row['nbreJourLot'].'</td></tr><br/>';
    //echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
}

echo "</table>";

// ---- Mise en place de la table des enchères à venir ---- //

echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix actuel</th><th>Prix max</th><th>Date heure début</th><th>date heure fin</th><th>Etat</th><th> Acheteur actuel : </th><th> Nombre de jours du lot ... </th></tr>";

echo "<br/>Enchères à venir : <br/>";

foreach ($programmee as $row ) {
	echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td><td>.'.$row['nbreJourLot'].'</td></tr><br/>';
}

echo "</table>";

echo "<br/><br/><p> Vous devez être connecté pour participer aux enchères</p>";
}


//-----------------------Connecté--------------------------

// ---- Mise en place de la première table ---- // 
else
	{
		echo "<br/>Enchères en cours : <br/>";

		?>
			
		<form method="post" action="<?php echo site_url ('utilisateur/prix'); ?>">

		<?php
		echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix actuel</th><th>Prix max</th><th>Date heure début</th><th>date heure fin</th><th>Etat</th><th> Acheteur actuel : </th><th> Nombre de jours du lot ... </th></tr>";

		foreach ($donnees as $row ) {
			echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td><td>.'.$row['nbreJourLot'].'</td></tr><br/>';
    //echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
		}

echo "</table>";

echo "<br/><br/>";
// ---- Mise en place du du choix du lot et du prix ---- // 
echo'Lot numéro : ';
echo '<select name="numLot">';
foreach ($donnees as $row ) {
	//$prix1 = $row["prixActuel"] + 1;
	echo'<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
	//echo '<input type="hidden" name="idlot" value="'.$row["IdLot"].'"></input>';
}
echo '</select>';

	echo '&nbsp &nbsp &nbsp<input type="number" name="prix" style="-moz-appearance: textfield" min="1" value="1" />&#8364 &nbsp &nbsp';
	echo '<input type="submit" name="action" value="Soumettre l\'offre" /> (l\'offre ne sera pas prise en compte si elle est inférieur au prix actuel ou supérieur au prix maximum) <br/><br/>';
/*fecho "<br/><br/>";
echo'Lot numéro : ';
echo '<select name="dateE">';
oreach ($donnees as $row ) {
	//$prix1 = $row["prixActuel"] + 1;
	echo'<option value='.$row["dateEnchere"].'>'.$row["dateEnchere"].'</option>';
	//echo '<input type="hidden" name="idlot" value="'.$row["IdLot"].'"></input>';
}*/
	echo "</select>";
/*foreach ($donnees as $row ) {
	$prix1 = $row["prixActuel"] + 1;
	echo'Lot numéro : '.$row["IdLot"].'&nbsp';
	echo '&nbsp &nbsp &nbsp<input type="number" name="prix" style="-moz-appearance: textfield" min="'.$prix1.'" value="'.$prix1.'" max="'.$row["prixEncheresMax"].'" />&#8364 &nbsp &nbsp';
	echo '<input type="submit" name="action" value="Soumettre l\'offre" /><br/><br/>';
	echo '<input type="hidden" name="idlot" value="'.$row["IdLot"].'"></input>';
}*/

// ---- Mise en place de la table des enchères à venir ---- // 

echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix actuel</th><th>Prix max</th><th>Date heure début</th><th>date heure fin</th><th>Etat</th></tr>";

echo "<br/>Enchères à venir : <br/>";

foreach ($programmee as $row ) {
	echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td></tr><br/>' ;
}


}

/*echo '<br/><p>Soumettre une offre : </p>';
echo '<input type="number" name="quantite" size="1" value="'.$row["prixDepart"].'" />';
echo '<input type="submit" name="action" value="Soumettre l\'offre" />';*/

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
