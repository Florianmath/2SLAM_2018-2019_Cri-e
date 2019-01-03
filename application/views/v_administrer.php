<?php

//----------------------- Admin connecté--------------------------

if ($_SESSION['login'] == 'administrateur') // sécuriter suplémentaire
{
	echo "<br/>Comptes administrateurs : <br/>";

	echo "<br/><table id='catalogue'><tr><th>Administrateurs</th></tr>";

	foreach ($compte_admin as $row ) {
		echo '<tr><td>'.$row['login'].'</td><td><br/>' ;

	   
	}

	echo "</table>";
}
?>

