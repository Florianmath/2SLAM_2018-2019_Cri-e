<div id="identitee">
<?php
	if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
	{
		echo 'Vous êtes un visiteur, pour vous connecter cliquez <a href = connecter> ici</a><br/> Pas de compte ? Pour vous inscrire cliquez <a href = admin> ici</a><br/>';
	}



	else 
	{
		echo '<p>Vous êtes : '.$_SESSION['login'].'</p>';
	}

?>
</div>