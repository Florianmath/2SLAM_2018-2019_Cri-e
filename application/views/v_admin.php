<style type="text/css">
.footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
           }
#logoInscription {
  color: #000000;
  margin-right: 20px;
}

</style>

<div class="alert alert-warning" role="alert">
<?php echo validation_errors(); ?> </div>

<form method="post" action="<?php echo site_url ('utilisateur/inscription'); ?>">
    <section>
        <fieldset>
            <legend>Vos Informations</legend>
                <p>
                    <br />
                    <label for="login">Votre login :</label>
                    <input type="text" name="login"  />

                    <br/>
                    <label for="pwd">Votre mot de passe :</label>
                    <input type="password" name="pwd"  />

                    <br />
                    <label for="rue">Votre rue :</label>
                    <input type="text" name="rue"  />

                    <br />
                    <label for="numRue">Votre numéro de rue:</label>
                    <input type="number" name="numRue"  />

                    <br />
                    <label for="ville">Votre ville :</label>
                    <input type="text" name="ville"  />

                    <br />
                    <label for="codePostal">Votre code postal :</label>
                    <input type="number" name="codePostal"  /><br/>


                    <br />
                <!---                   ---- MISE EN PLACE DES CGU ----



                Le but : mettre en place des conditions d'utilisation qui, lorsque l'on clique dessus, renvoit vers une vue
                    "v_conditions". Cette vue sera composée de règles d'utilisation du site (osef).
                      Comment ?
                      HTML :
                   <label>J'ai lu et j'accepte les conditions d'utilisation : </label> <input type="checkbox" name="cgu">
                    



                      BDD :
                      Mettre en place un nouveau champ "conditionGeneral" booléen dans une table (acheteur ?)
                   OU Mettre en place un nouvelle table "conditions" avec "conditionsGeneral" booléen 
                      
                      PHP :
                        utilisateur :
                            Dans formulaire rajouter :
                            $recupCgu = $_POST['cgu'];

                            if(isset($_POST['cgu'])){
                              $recupCgu = $_POST['cgu'];
                            }


                        model : 
                        Ne pas toucher (récupérer via la fonction enregistreAcheteur())
                        




                 -->

                    <br />


                    <!-- Pour les boutons-->
                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                    <br />
                </p>
            </fieldset>
    </section>
</form>
