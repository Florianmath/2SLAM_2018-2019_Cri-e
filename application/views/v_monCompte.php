<style type="text/css">
.footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
           }
#logoCompte {
  color: #000000;
  margin-right: 20px;
}
</style>

<h3> Vos données : </h3> </br>

<?php
echo '<input type="hidden" name="login" value="'.$_SESSION['login'].'">';
echo ' Votre login : '. $_SESSION['login'] .'</br>';
echo ' Votre mot de passe ' .$_SESSION['pwd'].'</br>';
foreach ($resultats as $row)
{
	echo ' Votre numéro de rue :  '. $row['numRue']. '</br>
	 	   Votre rue :' .$row['rue'] .'</br>
	 	   Votre ville : '.$row['ville'].'</br>
	 	   Votre code postal :' .$row['codePostal'].'</br>
       Votre numéro habilitation :'. $row['numHabilitation'].'</br>';
}

echo 'Modifier vos informations concernant votre adresse en cliquant <a href = modificationAdresse> ici </a>';
?>

