<?php

class Main_model extends CI_Model {

  /*Private $id;
  Private $nom;
  Private $prenom;*/

  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  protected $table = 'acheteur';

  public function afficheProduits(){
    /*
    //Preparation
    $this->load->database();
    $code="aut";
    */
    //Requete
    $sql=$this->db->conn_id->prepare ("SELECT IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel FROM lot, bateau, espece, peche, taille, presentation, qualite WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='en cours'");
    $sql->execute();
    $donnees=$sql->fetchAll();//Execution totale
    //ferme la connexion
    //$this->db=null;
    return $donnees;
  }

  public function afficheEnchereProgrammee(){
    $sql3=$this->db->conn_id->prepare ("SELECT IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel FROM lot, bateau, espece, peche, taille, presentation, qualite WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='programmée'");
    $sql3->execute();
    $programmee=$sql3->fetchAll();
    return $programmee;
  }

  public function afficheAdministrateurs(){
    /*
    //Preparation
    $this->load->database();
    $code="aut";
    */
    //Requete
    $sql4=$this->db->conn_id->prepare ("SELECT * FROM view_admin");
    $sql4->execute();
    $compte_admin=$sql4->fetchAll();//Execution total
    //ferme la connexion
    //$this->db=null;
    return $compte_admin;
  }

  public function recupIdBateau()
  {
    $sql5=$this->db->conn_id->prepare ("SELECT * FROM bateau");
    $sql5->execute();
    $bat=$sql5->fetchAll();
    return $bat;
  }



  public function lesreferences()
  {
    $sql2=$this->db->conn_id->prepare ('SELECT nomEspece FROM espece');
    $sql2->execute();
    $test=$sql2->fetchAll();//Execution total
    //ferme la connexion
    //$this->db=null;
    return $test;
  }

  public function enregistreAcheteur($data)
  {
    $this->db->insert('acheteur', $data);
  }

  public function enregistreBateau($tab)
  {
    $this->db->insert('bateau', $tab);
  }

  public function enregistreEspece($tab)
  {
    $this->db->insert('espece', $tab);
  }

  public function enregistrePeche($tab)
  {
    $this->db->insert('peche', $tab);
  }

  public function enregistrePrix($nouveauPrix, $idlot)
  {
    $this->db->set('prixActuel', $nouveauPrix);
    $this->db->where('IdLot', $idlot);
    $this->db->update('lot');
  }

public function enregistreIdAcheteur($loginAcheteur, $idlot)
{
  $this->db->select('IdAcheteur')
  ->from('acheteur')
  ->where('login', $loginAcheteur);
   $query = $this->db->get();
   foreach ($query->result() as $row)
{
    $IdAcheteur = $row->IdAcheteur;
}

  $this->db->set('IdAcheteur', $IdAcheteur);
  $this->db->where('IdLot', $idlot);
  $this->db->update('lot');
}

public function userLogin($login,$pwd)
{

  return $this->db->select('login,pwd')
  ->from($this->table)
  ->where('login', $login)
  ->where('pwd', $pwd)
  ->get()
  ->result();
}

public function etatEnchere($gmdate)
{
  $this->db->set('codeEtat', 'terminé');
  $this->db->where('dateHeureFin <', $gmdate);
  $this->db->update('lot');
}

public function etatEnchereProg($gmdate)
{
  $this->db->set('codeEtat', 'en cours');
  $this->db->where('dateEnchere <', $gmdate);
  $this->db->where('dateHeureFin >', $gmdate);
  $this->db->update('lot');
}

}

?>
