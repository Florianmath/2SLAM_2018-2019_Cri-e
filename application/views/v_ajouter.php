<?php
echo '<div class="alert alert-warning" role="alert">';
echo validation_errors(); ?> </div>

<form method="post" action="<?php echo site_url ('utilisateur/enregistreBateau'); ?>">
                <p>
                  Enregistrer un nouveau bateau :
                    <br/>
                    <label for="IdBateau">Id bateau : </label>
                    <input type="text" name="IdBateau"/> &nbsp &nbsp

                    <label for="nomBateau">Nom du bateau : </label>
                    <input type="text" name="nomBateau"/> &nbsp &nbsp

                    <label for="immatriculationBateau">immatriculation du bateau : </label>
                    <input type="text" name="immatriculationBateau"/> &nbsp &nbsp

                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form><br/><br/>


<form method="post" action="<?php echo site_url ('utilisateur/enregistreEspece'); ?>">
                <p>
                  Enregistrer une espece de poisson :
                    <br/>
                    <label for="IdEspece">Id de l'espece : </label>
                    <input type="text" name="IdEspece"/> &nbsp &nbsp

                    <label for="nomEspece">Nom de l'espece : </label>
                    <input type="text" name="nomEspece"/> &nbsp &nbsp

                    <label for="nomCommunEspece">Nom commun de l'espece : </label>
                    <input type="text" name="nomCommunEspece"/> &nbsp &nbsp

                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form><br/><br/>


<form method="post" action="<?php echo site_url ('utilisateur/enregistrePeche'); ?>">
                <p>
                  Enregistrer une pêche :
                    <br/>
                    <label for="IdBateau">Id du bateau : </label>
                    <select name="IdBateau">
                    <?php
                    foreach ($bat as $row) {
                    	echo '<option value='.$row["IdBateau"].'>'.$row["IdBateau"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <label for="datePeche">Date de la peche : </label>
                    <input type="date" name="datePeche"/> &nbsp &nbsp


                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form>
