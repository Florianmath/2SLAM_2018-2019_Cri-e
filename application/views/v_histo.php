<style type="text/css">

#logoHisto {
  color: #000000;
  margin-right: 20px;
}
</style>

<div class="table-responsive">
  <table id='catalogue' class="table">
    <thead>
<?php
if ($enchereacceptee == null && $enchereannulee == null)
{
  echo "Aucune enchère dans l'historique";
}

else
{
  if ($enchereacceptee == null)
  {
    echo "Aucune enchère accepté";
  }
  else {

echo "Historique des encheres validées :";

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
      <th scope=\"col\"> Acheteur</th>
      </tr>";

foreach ($enchereacceptee as $row ) {
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


<div class="table-responsive">
  <table id='catalogue' class="table">
    <thead>
<?php
if ($enchereannulee == null)
{
  echo "Aucune enchère annulée";
}
else
{
echo "<br/><p> Historique des encheres annulées : </p>";
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
      <th scope=\"col\"> Acheteur</th>
      </tr>";

foreach ($enchereannulee as $row ) {
  echo '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.PNG"</img></td><td>'.$row['IdLot'].'</td><td>'.$row['nomBateau'].'</td><td>'.$row['nomEspece'].'</td><td>'.$row['specification'].'</td><td>'.$row['libellePresentation'].'</td><td>'.$row['LibelleQualite'].'</td><td>'.$row['poidsBrutLot'].'</td><td>'.$row['dateHeureFin'].'</td><td>'.$row['prixActuel'].'</td><td>'.$row['codeEtat'].'</td><td>'.$row['login'].'</td></tr><br/>';
      //echo  '<tr><td><img src="'.base_url('Images/').$row['nomEspece'].'.JPG"</img></td><td>'.$row['nomEspece'].'</td></tr>'.'<br/>';
}
}
}
?>
    </thead>
  </table>
</div>
<?php
echo "</table>";
