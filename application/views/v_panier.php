<!-- Pour le css-->

<style type="text/css">
.footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
           }

#logoPanier{
  color: #000000;
  margin-right: 20px;
}
<?php
$i = 0;
foreach ($enchereacceptee as $row )
{
  if ($row['login'] == $_SESSION['login'])
  {
      $i = $i + 1;
  }
}
 ?>
</style>
	<div class="table-responsive">
	  <table id='catalogue' class="table">
			<thead>
		<?php
    if ($i == 0)
    {
      echo "Il n'y a pas d'enchère dans votre panier";
      ?>
       <br/><a href ="<?php echo site_url ('utilisateur/contenu/catalogue'); ?>"id="logoPoisson">Cliquez ici pour voir les enchères</a>
       <?php
    }
    else {
		echo "<tr class=\"table-primary\"><th scope=\"col\">Photo</th>
					<th scope=\"col\">IdLot</th>
					<th scope=\"col\">Bateau</th>
					<th scope=\"col\">Espece</th>
					<th scope=\"col\">Taille</th>
					<th scope=\"col\">Presentation</th>
					<th scope=\"col\">Qualite</th>
					<th scope=\"col\">Poids Brut</th>
          <th scope=\"col\">date fin</th>
					<th scope=\"col\">Prix</th>
					<th scope=\"col\">Etat</th>
					<th scope=\"col\"> Acheteur : </th>
					</tr>";

		foreach ($enchereacceptee as $row ) {
      if ($row['login'] == $_SESSION['login'])
			echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.PNG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td></tr><br/>';
	    		//echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
		}
}
		?>
				</thead>
			</table>
		</div>
		<?php
		echo "</table>";
    ?>
