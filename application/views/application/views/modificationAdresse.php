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

<?php
?>
<h2> Modification de l'adresse : </h2>
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
                


