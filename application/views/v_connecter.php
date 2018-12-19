<div id="login">
    <form class ="form_user form-horizontal" method="post" action="">
        <h4>Connexion :</h4>

            <label class="control-label" for="email">Email :</label>

                <input class="validate[required,custom[email]]" type="text" name="id" placeholder="Email" value="<?php echo set_value('email'); ?>">
                    <?php echo form_error('email'); ?>


          <br/><br/>

            <label class="control-label" for="mdp">Mot de passe :</label>

                <input class="validate[required]" type="password" id="inputPassword" placeholder="Password" name="mdp">
                    <?php echo form_error('mdp'); ?>


        <br/><br/>
        <button class="btn btn-large btn-primary" type="submit">Valider</button>

    </form>
    <?php
 if ($this->session->flashdata('noconnect'))
 echo "<div class=\"alert alert-error\">
   <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
  <strong>" . $this->session->flashdata('noconnect') . "<strong>
 </div>";
 ?>
</div>
