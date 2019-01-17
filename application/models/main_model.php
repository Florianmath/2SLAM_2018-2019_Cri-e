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
        $sql=$this->db->conn_id->prepare ("SELECT  login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel, nbreJourLot FROM acheteur, lot, bateau, espece, peche, taille, presentation, qualite WHERE lot.IdAcheteur = acheteur.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='en cours'");
            /*(SELECT DATEDIFF(day, '2014-01-09', '2014-01-01');)*/
        $sql->execute();
        $donnees=$sql->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $donnees;
    }

    public function afficheEnchereProgrammee(){
         $sql3=$this->db->conn_id->prepare ("SELECT  login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel, nbreJourLot FROM acheteur, lot, bateau, espece, peche, taille, presentation, qualite WHERE lot.IdAcheteur = acheteur.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='programmée'");
        $sql3->execute();
        $programmee=$sql3->fetchAll();
        return $programmee;
    }


   /* FONCTION D'AFFICHAGE : Permet d'afficher dans l'onglet Administrateur les enchères terminées : même chose que les autres sauf qu'on remplace le codeEtat */ 
    public function afficheEnchereTerminee(){
        $sql16=$this->db->conn_id->prepare ("SELECT login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel FROM lot, bateau, espece, peche, taille, presentation, qualite, acheteur WHERE acheteur.IdAcheteur = lot.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat ='terminé'");
        $sql16->execute();
        $enchereterminee=$sql16->fetchAll();
        return $enchereterminee;
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
/* FONCTION D'AFFICHAGE : Permet d'afficher les utilisateurs : même chose qu'affiche administrateur, on met juste un where pour tout afficher sauf les admins. ATTENTION : si on met en place un nouveau choix qui n'est pas ni administrateur ni utilisateur, cela va l'afficher, à changer si cela arrive */ 

    public function afficheUtilisateur(){
        $sql18=$this->db->conn_id->prepare ("SELECT DISTINCT login FROM acheteur WHERE login <> 'administrateur'");
        $sql18->execute();
        $compte_utilisateur=$sql18->fetchAll();
        return $compte_utilisateur;
    }

    public function recupIdBateau()
    {
      $sql5=$this->db->conn_id->prepare ("SELECT * FROM bateau");
      $sql5->execute();
      $bat=$sql5->fetchAll();
      return $bat;
    }

    public function recupDatePeche()
    {
        $sql7=$this->db->conn_id->prepare ("SELECT peche.datePeche FROM peche ");
        $sql7->execute();
        $peche=$sql7->fetchAll();
        return $peche;
    }

    public function recupEspece()
    {
        $sql12=$this->db->conn_id->prepare ("SELECT espece.IdEspece FROM espece ");
        $sql12->execute();
        $espece=$sql12->fetchAll();
        return $espece;
    }

    public function recupTaille()
    {
        $sql9=$this->db->conn_id->prepare ("SELECT taille.IdTaille FROM taille");
        $sql9->execute();
        $taille=$sql9->fetchAll();
        return $taille;
    }

    public function recupPresentation()
    {
        $sql10=$this->db->conn_id->prepare("SELECT presentation.IdPresentation FROM presentation");
        $sql10->execute();
        $presentation = $sql10->fetchAll();
        return $presentation;
    }

    public function recupBac()
    {
        $sql11=$this->db->conn_id->prepare("SELECT bac.IdBac FROM bac");
        $sql11->execute();
        $bac = $sql11->fetchAll();
        return $bac;
    }

    public function recupAcheteur()
    {
        $sql12=$this->db->conn_id->prepare("SELECT acheteur.IdAcheteur FROM acheteur");
        $sql12->execute();
        $acheteur = $sql12->fetchAll();
        return $acheteur;
    }

    public function recupQualite()
    {
        $sql13=$this->db->conn_id->prepare("SELECT qualite.IdQualite FROM qualite");
        $sql13->execute();
        $qualite = $sql13->fetchAll();
        return $qualite;
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

    public function enregistreLot($tab)
    {
        $this->db->insert('lot', $tab);
        //$req = $bdd->prepare('INSERT INTO lot(IdLot, poidsBrutLot, prixPlancher, prixDepart, prixActuel, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, IdFacture) VALUES(:IdLot, :poidsBrutLot, :prixPlancher, :prixDepart, :prixActuel, :prixEncheresMax, :dateEnchere, :dateHeureFin, :codeEtat, :IdFacture)');
        
    }

    public function enregistrePresentation($tab)
    {
        $this->db->insert('presentation', $tab);
    }




    public function enregistrePrix($nouveauPrix, $idlot)
    {
      $this->db->set('prixActuel', $nouveauPrix);
      $this->db->where('IdLot', $idlot);
      $this->db->update('lot');
    }

    public function enregistreDateEnchere($nouvelleDate)
    {
        $this->Db->set('dateEnchere', $nouvelleDate);
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
/* Tentative de mettre en place le nombre de lot. Pas de where car pas d'obligations particulières,
    Problème : relier dateEnchere de la BDD à une variable $dateEnchere */

    public function nombreLot($gmdate1)
    {
        $this->db->set('nbreJourLot', $gmdate1);
        $this->db->update('lot');
    }

/* ----- FONCTIONS ETAT : Permettent de mettre en place la qualité en direct ----- */

    public function etatEnchereProg($gmdate)
    {
      $this->db->set('codeEtat', 'en cours');
      $this->db->where('dateEnchere <', $gmdate);
      $this->db->where('dateHeureFin >', $gmdate);
      $this->db->update('lot');
    }
    public function etatQualiteOriginal($etatq)
    {
        $this->db->set('IdQualite', 'or');
        $this->db->where('nbreJourLot <', $etatq );
        $this->db->update('lot');
    }
    public function etatQualiteBonne($etatq, $etatq2)
    {
        $this->db->set('IdQualite', 'bo');
        $this->db->where('nbreJourLot <', $etatq2 );
        $this->db->where('nbreJourLot >', $etatq);
        $this->db->update('lot');
    }
    public function etatQualiteMoyenne($etatq2, $etatq3)
    {
        $this->db->set('IdQualite', 'mo');
        $this->db->where('nbreJourLot <', $etatq3 );
        $this->db->where('nbreJourLot >', $etatq2);
        $this->db->update('lot');
    }
    public function etatQualiteMauvaise($etatq3, $etatq4)
    {
        $this->db->set('IdQualite', 'ma');
      //  $this->db->where('nbreJourLot <', $etatq4);
        $this->db->where('nbreJourLot >', $etatq3);
        $this->db->update('lot');
    }


 /*   public function taillePetite($taille1)
    {
        $this->db->set('IdTaille', 'pet');
        $this->db->where('taillecm <', $taille1);
        $this->db->update('taille');
    }

    public function tailleMoyenne($taille1, $taille2)
    {
        $this->db->set('IdTaille', 'moy');
        $this->db->where('taillecm >', $taille1);
        $this->db->where('taillecm <', $taille2);
        $this->db->update('taille');
    }

    public function tailleGrande($taille2)
    {
        $this->db->set('IdTaille', 'gra');
        $this->db->where('taillecm >', $taille2);
        $this->db->update('taille');
    }*/
/* ----- FIN FONCTIONS ETAT ----- */


 
// Tentative de mettre en place le "meilleur acheteur", càd celui qui arrive à acheter l'enchère terminée, pas réussi pour l'instant, à voir car incomplet actuellement. 
 /*public function afficheMeilleurAcheteur()
    {
        $sql17=$this->db->conn_id->prepare("SELECT DISTINCT login WHERE acheteur.IdAcheteur = lot.IdAcheteur AND MAX(prixActuel) = prixActuel");
        $sql17->execute();
        $meilleuracheteur=$sql17->fetchAll();
        return $meilleuracheteur;
    }*/
}  
?>
