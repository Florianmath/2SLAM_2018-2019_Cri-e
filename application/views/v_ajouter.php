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

<form method="post" action="<?php echo site_url ('utilisateur/enregistreLot'); ?>">
                <p>
                  Enregistrer un lot :
                    <br/><br>
                    <label for="IdLot">L'Id du lot  </label>
                    <input type="text" name="IdLot"/> &nbsp &nbsp

                    <select name="IdEspece">
                    <?php
                    foreach ($espece as $row) {
                        echo '<option value='.$row["IdEspece"].'>'.$row["IdEspece"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdBateau">
                    <?php
                    foreach ($bat as $row) {
                        echo '<option value='.$row["IdBateau"].'>'.$row["IdBateau"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="datePeche">
                    <?php
                    foreach ($peche as $row) {
                        echo '<option value='.$row["datePeche"].'>'.$row["datePeche"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdTaille">
                    <?php
                    foreach ($taille as $row) {
                        echo '<option value='.$row["IdTaille"].'>'.$row["IdTaille"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdPresentation">
                    <?php
                    foreach ($presentation as $row) {
                        echo '<option value='.$row["IdPresentation"].'>'.$row["IdPresentation"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdBac">
                    <?php
                    foreach ($bac as $row) {
                        echo '<option value='.$row["IdBac"].'>'.$row["IdBac"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdAcheteur">
                    <?php
                    foreach ($acheteur as $row) {
                        echo '<option value='.$row["IdAcheteur"].'>'.$row["IdAcheteur"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <select name="IdQualite">
                    <?php
                    foreach ($qualite as $row) {
                        echo '<option value='.$row["IdQualite"].'>'.$row["IdQualite"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <label for="poidsBrutLot">Le poids Brut  :   </label>
                    <input type="text" name="poidsBrutLot"/> &nbsp &nbsp 

                    <label for="prixPlancher">Prix planché :   </label>
                    <input type="text" name="prixPlancher"/> &nbsp &nbsp

                    <label for="prixDepart">Prix de départ : </label>
                    <input type="text" name="prixDepart"/> &nbsp &nbsp

                    <label for="prixActuel">prix Actuel : </label>
                    <input type="text" name="prixActuel"/> &nbsp &nbsp

                    <label for="prixEncheresMax">Prix de l'enchère max : </label>
                    <input type="text" name="prixEncheresMax"/> &nbsp &nbsp

                    <label for="dateEnchere">Date de l'enchère : </label>
                    <input type="date" name="dateEnchere"/> &nbsp &nbsp

                    <label for="dateHeureFin">Date de fin : </label>
                    <input type="date" name="dateHeureFin"/> &nbsp &nbsp

                    <label for="IdFacture">Id de la facture : </label>
                    <input type="text" name="IdFacture"/> &nbsp &nbsp 


                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form>

<form method="post" action="<?php echo site_url ('utilisateur/enregistrePresentation'); ?>">
                <p>
                  Enregistrer une nouvelle présentation de lot :
                    <br/><br>
                    <label for="IdPresentation">Id de la présentation : </label>
                    <input type="text" name="IdPresentation"/> &nbsp &nbsp

                    <label for="libellePresentation">Libellé de la présentation : </label>
                    <input type="text" name="libellePresentation"/> &nbsp &nbsp

                    <select name="IdEspece">
                    <?php
                    foreach ($espece as $row) {
                        echo '<option value='.$row["IdEspece"].'>'.$row["IdEspece"].'</option>';
                    }?>
                    </select>&nbsp &nbsp

                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form><br/><br/>


</form>
