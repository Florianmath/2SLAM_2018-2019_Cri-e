<?php

//----------------------- Admin connecté--------------------------

if ($_SESSION['login'] == 'administrateur') // sécuriter suplémentaire
{
	echo "<br/>Comptes administrateurs : <br/>";

	echo "<br/><table id='catalogue'><tr><th>Administrateurs</th></tr>";
// ---- VA CHERCHER LES COMPTES ADMINS (il n'y en a qu'un) ---- // 
	foreach ($compte_admin as $row ) {
		echo '<tr><td>'.$row['login'].'</td><td><br/>' ;   
	}
	echo "</table>";
	echo "</table><br/><br/>";
	echo "</form>";

	echo "<br/><table id='catalogue'><tr><th>Utilisateurs</th></tr>";
// ---- VA CHERCHER TOUS LES COMPTES UTILISATEURS ---- // 
	foreach ($compte_utilisateur as $row ) {
		echo '<tr><td>'.$row['login'].'</td><td><br/>' ;   
	}
	echo "</table>";
	echo "</table><br/><br/>";
	echo "</form>";

	echo "<form>";
	echo "<table id='catalogue'><tr><th>Photo</th><th>IdLot</th><th>Bateau</th><th>Espece</th><th>Taille</th><th>Presentation</th><th>Qualite</th><th>Poids Brut</th><th>Prix Depart</th><th>Prix actuel</th><th>Prix max</th><th>Date heure début</th><th>date heure fin</th><th>Etat</th><th>Acheteur</th></tr>";
// ---- VA AFFICHER TOUTES LES ENCHERES TERMINEES (avec acheteur " a " uniquement car bug ) ---- // 
	echo "<br/> Enchères terminées : <br/>";
	foreach ($enchereterminee as $row){
		echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td></tr><br/>' ;
	}
	echo "</table><br/><br/>";
	echo "</form>";

}
?>

