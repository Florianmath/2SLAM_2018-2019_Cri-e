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
//	echo "<br/>Comptes administrateurs : <br/>";

//	echo "<br/><table id='catalogue'><tr><th>Administrateurs</th></tr>";
// ---- VA CHERCHER LES COMPTES ADMINS (il n'y en a qu'un) ---- //
	foreach ($compte_admin as $row ) {
			?>
			<!-- <div class="table-responsive">
			  <table id='catalogue' class="table">
					<thead>
			<?php
			echo "<tr class=\"table-primary\"><th scope=\"col\">Comptes administrateurs :</th></tr>";
			echo '<tr><td>'.$row['login'].'</td></tr>';
	}

	?>
		</thead>
	</table>
	</div> -->
	<?php

	//echo "<br/><table id='catalogue'><tr><th>Utilisateurs</th></tr>";
// ---- VA CHERCHER TOUS LES COMPTES UTILISATEURS ---- //
	?>

	<?php

	?>
	<div class="table-responsive">
	  <table id='catalogue' class="table">
			<thead>
				<?php

	echo "<tr class=\"table-primary\"><th scope=\"col\">Photo</th>
				<th scope=\"col\">IdLot</th>
				<th scope=\"col\">Bateau</th>
				<th scope=\"col\">Espece</th>
				<th scope=\"col\">Taille</th>
				<th scope=\"col\">Presentation</th>
				<th scope=\"col\">Qualite</th>
				<th scope=\"col\">Poids Brut</th>
				<th scope=\"col\">Prix Depart</th>
				<th scope=\"col\">Prix actuel</th>
				<th scope=\"col\">Prix max</th>
				<th scope=\"col\">Date heure début</th>
				<th scope=\"col\">date heure fin</th>
				<th scope=\"col\">Etat</th>
				<th scope=\"col\">Acheteur</th></tr>";

// ---- VA AFFICHER TOUTES LES ENCHERES TERMINEES (avec acheteur " a " uniquement car bug ) ---- //
	echo "<br/> Enchères terminées :";
	echo "<br/>";
	?>

		<?php

		foreach ($enchereterminee as $row){
		//	echo '<form method="get" action="<?php echo site_url ("utilisateur/suppressionLot")">';
			echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.PNG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['prixDepart'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['prixEncheresMax'].'</td><td>'.$row['dateEnchere'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td></tr><br/>' ;
		//	echo "</form>";
		}

		?>
		</thead>
	</table>
	</div>
	<?php

	echo "</table><br/><br/>";

	echo "</form>";

	}
?>

	<form method="get" action="<?php echo site_url ('utilisateur/refusLot'); ?>">
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

    Accepter :

    <form method="get" action ="<?php echo site_url ('utilisateur/validationLot'); ?>">
    	<p>
    		 <br/>
    		 	    <select name="IdLot">
                    <?php
                    foreach ($recupLot as $row) {
                        echo '<option value='.$row["IdLot"].'>'.$row["IdLot"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <!-- <label for="IdFacture">Identifiant de cette facture: </label>
                    <input type="text" name="IdFacture"/> &nbsp &nbsp -->
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
