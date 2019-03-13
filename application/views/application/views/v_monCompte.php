<style type="text/css">
#logoCompte {
  color: #000000;
  margin-right: 20px;
}
</style>

<h3> Vos données : </h3> </br>

<?php
echo '<input type="hidden" name="login" value="'.$_SESSION['login'].'">';
echo ' Votre login : '. $_SESSION['login'] .'</br>';
echo ' Votre mot de passe : ' .$_SESSION['pwd'].'</br>';
foreach ($resultats as $row)
{
	echo ' Votre numéro de rue :  '. $row['numRue']. '</br>
	 	   Votre rue : ' .$row['rue'] .'</br>
	 	   Votre ville : '.$row['ville'].'</br>
	 	   Votre code postal : ' .$row['codePostal'].'</br>
       Votre numéro habilitation : '. $row['numHabilitation'].'</br>';
}

//echo 'Modifier vos informations concernant votre adresse en cliquant <a href = modificationAdresse> ici </a>';
?>



</br>
	<!--<h2> Modification de l'adresse : </h2>-->
	<h4> Veuillez renseigner les champs ci-dessous si vous voulez modifier votre adresse </h4> <br></br>
	<form method="post" action="<?php echo site_url ('utilisateur/modificationNumRue'); ?>">
					<p>
			  <label for="numRue">Votre nouveau numéro de rue: </label>
					<input type="text" name="numRue"/> &nbsp &nbsp
					<input class="btn btn-large btn-primary" type="submit" value="Valider" />
					<input class="btn btn-large btn-primary" type="reset" value="Effacer" /><br></br>
					</p>
	</form>
	<form method="post" action="<?php echo site_url ('utilisateur/modificationRue'); ?>">
					<p>
						<label for="rue">Votre nouvelle rue : </label>
						<input type="text" name="rue"/> &nbsp &nbsp
						<input class="btn btn-large btn-primary" type="submit" value="Valider" />
						<input class="btn btn-large btn-primary" type="reset" value="Effacer" /><br></br>
					</p>
	</form>
	<form method="post" action="<?php echo site_url ('utilisateur/modificationVille'); ?>">
					<p>

						<label for="ville">Votre nouvelle ville : </label>
						<input type="text" name="ville"/> &nbsp &nbsp
						<input class="btn btn-large btn-primary" type="submit" value="Valider" />
						<input class="btn btn-large btn-primary" type="reset" value="Effacer" /><br></br>
					</p>
	</form>
	<form method="post" action="<?php echo site_url ('utilisateur/modificationCodePostal'); ?>">
					<p>
						<label for="codePostal">Votre nouveau code postal : </label>
						<input type="text" name="codePostal"/> &nbsp &nbsp
						<input class="btn btn-large btn-primary" type="submit" value="Valider" />
						<input class="btn btn-large btn-primary" type="reset" value="Effacer" /><br></br>
					</p>
	</form>
	<form method="post" action="<?php echo site_url ('utilisateur/modificationNumHabilitation'); ?>">
					<p>
						<label for="numHabilitation">Votre nouveau numéro d'habitation : </label>
						<input type="text" name="numHabilitation"/> &nbsp &nbsp
						<input class="btn btn-large btn-primary" type="submit" value="Valider" />
						<input class="btn btn-large btn-primary" type="reset" value="Effacer" />
					</p>
	</form>
                
<?php
?>