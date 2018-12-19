<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>

    <section>
        <fieldset>
            <legend>Vos Informations</legend>
                <p>
                    <label for="nom">Votre nom :</label>
                    <input type="text" name="nom" autofocus />

                    <br />
                    <label for="prenom">Votre prénom :</label>
                    <input type="text" name="prenom"  />
                    
                    <br />
                    <label for="adresse">Votre adresse :</label>
                    <input type="text" name="adresse"  />

                    <br />
                    <label for="ville">Votre ville:</label>
                    <input type="text" name="ville"  />

                    <br />
                    <label for="cp">Votre code postal:</label>
                    <input type="number" name="cp"  />

                    <br />
                    <label for="tel">Votre numéro de téléphone:</label>
                    <input type="number" name="tel"  />

                    <br />
                    <label for="mail">Votre mail :</label>
                    <input type="text" name="mail"  />

                    
                    <br/>
                    <label for="pwd">Votre mot de passe :</label>
                    <input type="password" name="pwd"  /><br/>
                    
                    <br /><br />

                        
                    <!-- Pour les boutons-->
                    <input type="submit" value="Valider" />
                    <input type="reset" value="Effacer" />
                    <br />
                </p>
            </fieldset>
    </section>
</form>
