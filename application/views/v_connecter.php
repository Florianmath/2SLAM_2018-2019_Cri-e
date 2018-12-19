
<fieldset>
	<?php if (!isset($_SESSION['login']) && !isset($_SESSION['pwd']))
	{?>
    <div id="login">
        <form method="post" action="<?php echo site_url ('utilisateur/contenu/connection'); ?>">
            <h4>Connexion :</h4>

                <label class="control-label" for="login">Login :</label>

                    <input class="validate[required,custom[login]]" type="text" name="login" placeholder="login" value="<?php echo set_value('login'); ?>">
                        <?php echo form_error('login'); ?>


              <br/><br/>

                <label class="control-label" for="pwd">Mot de passe :</label>

                    <input class="validate[required]" type="password" id="pwd" placeholder="Password" name="pwd">
                        <?php echo form_error('pwd'); ?>


            <br/><br/>
            <button class="btn btn-large btn-primary" type="submit">Valider</button>

        </form>
        <?php

	}
	else
	{
		echo 'Bonjour  '.$login;
	}
     
     
    /*
	if ($this->session->flashdata('noconnect')) 
     echo "<div class=\"alert alert-error\">
       <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
      <strong>" . $this->session->flashdata('noconnect') . "<strong>
     </div>";


     echo "Bienvenue ",$data['login']; ?>  
     <a href="deconnexion">Déconnexion</a> ?>
    */

     if (isset($erreur))
		  echo $erreur;
	
		

     ?>


    </div>
</fieldset>