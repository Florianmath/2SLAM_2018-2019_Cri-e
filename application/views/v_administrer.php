<style type="text/css">
#logoAdministrer {
  color: #000000;
  margin-right: 20px;
}
</style>
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
	?>

	<?php

	foreach ($enchereterminee as $row){
	//	echo '<form method="get" action="<?php echo site_url ("utilisateur/suppressionLot")">';
		echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td></tr><br/>' ;
	//	echo "</form>";
	}



	echo "</table><br/><br/>";

	echo "</form>";

	}
?>

	<form method="get" action="<?php echo site_url ('utilisateur/suppressionLot'); ?>">
		<p>
			
                    <select name="IdLot">
                    <?php
                    foreach ($recupLot as $row) {
                        echo '<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
                    }?>
                    </select>&nbsp &nbsp
            <input class="btn btn-large btn-primary" type="submit" value="Suppression" /> 
       </p>
    </form>

    Création d'une nouvelle facture : 

    <form method="post" action ="<?php echo site_url ('utilisateur/facture'); ?>">
    	<p>
    		 <br/>
    		 	    <select name="IdLot">
                    <?php
                    foreach ($recupLot as $row) {
                        echo '<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <label for="IdFacture">Identifiant de cette facture: </label>
                    <input type="text" name="IdFacture"/> &nbsp &nbsp
                 <!--   <label for="libelleFacture">Libelle de cette facture: </label>
                    <input type="text" name="libelleFacture"/> &nbsp &nbsp-->


                <input class="btn btn-large btn-primary" type="submit" name="Valider" value="Valider" /> 
    </p>
</form>

<!-- <form method="post" action ="<?php echo site_url ('utilisateur/relierLot'); ?>">
    	<p>

                    <select name="IdLot">-->
                    <?php
                   /* foreach ($recupLot as $row) {
                        echo '<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdFacture">
                    <?php
                    foreach ($facture as $row) {
                        echo '<option value='.$row["IdFacture"].'>'.$row["IdFacture"].'</option>';
                    }*/?>
                   <!-- </select>&nbsp &nbsp


                <input class="btn btn-large btn-primary" type="submit" name="Valider" value="Valider" /> 
    </p>
</form>-->




    		<!--<select name="IdLot">-->
                
                 <!---   foreach ($recupLot as $row) {
                        echo '<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
                    }?>
                    </select>&nbsp &nbsp*
            
        </p>
    </form>
    <br>

		
			
		
	





