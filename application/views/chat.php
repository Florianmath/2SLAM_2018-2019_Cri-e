
<h3> Pour émettre un message, veuillez renseigner le champ ci-dessous </h3>

<h6><i> Vous êtes obligé de vous connecter pour émettre des messages</i> </h6><br></br>

<form method="post" action="<?php echo site_url ('utilisateur/insertMessage'); ?>">
                <p>

               <!--   <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />-->
           
                  <?php
                    echo '<input type="hidden" name="loginAcheteur" value="'.$_SESSION['login'].'">'; // permet l'affichage du pseudo avant, et dans la BDD $_SESSION['login'] = "administrateur"
                 //   echo $dateHeure;
                  ?>



                    <label for="message">Message</label> :  <input type="text" name="message" id="message"/><br><br />

                 <!-- <label for="dateHeure">Date</label> :  <input type="date" name="dateHeure" id="dateHeure"/><br><br />-->

                    <input class="btn btn-large btn-primary" type="submit" value="Valider" />
                    <input class="btn btn-large btn-primary" type="reset" value="Effacer" />
                  </p>
</form><br/><br/>
<?php
foreach ($recupMessage as $row ) 
{
    echo '<p>' . htmlspecialchars($row['dateHeure']). '  ' . '<strong>' . htmlspecialchars($row['login']) . '</strong> : ' . htmlspecialchars($row['message']) . '</p>';
}
    ?>
