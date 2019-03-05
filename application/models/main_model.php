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
        $sql=$this->db->conn_id->prepare ("SELECT DISTINCT  login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel, nbreJourLot FROM acheteur, lot, bateau, espece, peche, taille, presentation, qualite WHERE lot.IdAcheteur = acheteur.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='en cours'");
            /*(SELECT DATEDIFF(day, '2014-01-09', '2014-01-01');)*/
        $sql->execute();
        $donnees=$sql->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $donnees;
    }

    public function afficheEnchereProgrammee(){
         $sql3=$this->db->conn_id->prepare ("SELECT DISTINCT  login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel, nbreJourLot FROM acheteur, lot, bateau, espece, peche, taille, presentation, qualite WHERE lot.IdAcheteur = acheteur.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat='programmée'");
        $sql3->execute();
        $programmee=$sql3->fetchAll();
        return $programmee;
    }



   /* FONCTION D'AFFICHAGE : Permet d'afficher dans l'onglet Administrateur les enchères terminées : même chose que les autres sauf qu'on remplace le codeEtat */
    public function afficheEnchereTerminee(){
        $sql16=$this->db->conn_id->prepare ("SELECT DISTINCT login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel FROM lot, bateau, espece, peche, taille, presentation, qualite, acheteur WHERE acheteur.IdAcheteur = lot.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat ='terminé' AND IdFacture = 0");
        $sql16->execute();
        $enchereterminee=$sql16->fetchAll();
        return $enchereterminee;
    }

    public function afficheEnchereAcceptee(){
        $sql165=$this->db->conn_id->prepare ("SELECT DISTINCT login, IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, dateHeureFin, codeEtat, prixActuel FROM lot, bateau, espece, peche, taille, presentation, qualite, acheteur WHERE acheteur.IdAcheteur = lot.IdAcheteur AND bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite AND codeEtat ='accepté' ");
        $sql165->execute();
        $enchereacceptee=$sql165->fetchAll();
        return $enchereacceptee;
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
        $sql18=$this->db->conn_id->prepare ("SELECT DISTINCT login FROM acheteur WHERE login <> 'administrateur' AND login <> 'Personne'");
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
        $sql12=$this->db->conn_id->prepare("SELECT acheteur.IdAcheteur FROM acheteur WHERE IdAcheteur = 0");
        $sql12->execute();
        $acheteur = $sql12->fetchAll();
        return $acheteur;
    }

    public function recupLogin()
    {
        $sql30=$this->db->conn_id->prepare("SELECT acheteur.login FROM acheteur");
        $sql30->execute();
        $acheteur = $sql30->fetchAll();
        return $acheteur;
    }

    public function recupQualite()
    {
        $sql13=$this->db->conn_id->prepare("SELECT qualite.IdQualite FROM qualite");
        $sql13->execute();
        $qualite = $sql13->fetchAll();
        return $qualite;
    }

    public function recupLot()
    {
        $sql21=$this->db->conn_id->prepare("SELECT lot.IdLot FROM lot WHERE codeEtat = 'terminé' AND IdFacture = 0");
        $sql21->execute();
        $recupLot = $sql21->fetchAll();
        return $recupLot;
    }

    // public function recupLotAccepte()
    // {
    //     $sql21=$this->db->conn_id->prepare("SELECT lot.IdLot FROM lot WHERE codeEtat = 'accepté' ");
    //     $sql21->execute();
    //     $recupLot = $sql21->fetchAll();
    //     return $recupLotAccepte;
    // }

    public function recupFacture()
    {
        $sql18=$this->db->conn_id->prepare("SELECT lot.IdFacture FROM lot");
        $sql18->execute();
        $facture = $sql18->fetchAll();
        return $facture;
    }

    public function recupEEtat()
    {
        $sql99=$this->db->conn_id->prepare("SELECT DISTINCT lot.codeEtat FROM lot");
        $sql99->execute();
        $codeEtat = $sql99->fetchAll();
        return $codeEtat;
    }

    public function afficheDateEnchere(){

      /*  $sql23=$this->db->conn_id->prepare ("SELECT IdLot FROM lot order by desc "); // on prend le nombre de lots tt simplement
        $sql23->execute();
        $retourneLot=$sql23->fetchAll();*/

        $sql22=$this->db->conn_id->prepare ("SELECT IdLot, dateEnchere WHERE codeEtat = 'en cours' FROM lot"); // on prend le nbre de jour de IdLot num 3 (=12)
        $sql22->execute();
        $retourneDateE=$sql22->fetchAll();

        $dateDuJour = date('Y-m-d');
        $dateActuelle = strtotime($dateDuJour);

            foreach ($retourneDateE as $row)
             {
                $getLot = $row['IdLot'];
                $dateEnchere = strtotime($row['dateEnchere']);
                $gmdate1 = ceil(abs($dateActuelle - $dateEnchere) / 86400);
                $this->db->set('nbreJourLot', $gmdate1);
                $this->db->where('IdLot', $getLot);
                $this->db->update('lot');
             }


        }








         // ---- AFFICHE 31, c'est OK pour lot 1 -----






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

    public function facture($lafacture)
    {
        $this->db->insert('facture', $lafacture);
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
    }

    public function enregistrePresentation($tab)
    {
        $this->db->insert('presentation', $tab);
    }

    public function enregistreNouvelleNumRue($numRue)
    {
        $this->db->set('numRue', $numRue);
        $this->db->where('IdAcheteur', 3);
        $this->db->update('acheteur');
    }

    public function enregistreNouvelleRue($rue)
    {
        $this->db->set('rue', $rue);
        $this->db->where('IdAcheteur', 3);
        $this->db->update('acheteur');
    }

    public function enregistreNouvelleVille($ville)
    {
        $this->db->set('ville', $ville);
        $this->db->where('IdAcheteur', 3);
        $this->db->update('acheteur');
    }

    public function enregistreNouvelleCodePostal($codePostal)
    {
        $this->db->set('codePostal', $codePostal);
        $this->db->where('IdAcheteur', 3);
        $this->db->update('acheteur');
    }

    public function enregistreNouvelleNumHabilitation($numHabilitation)
    {
        $this->db->set('numHabilitation', $numHabilitation);
        $this->db->where('IdAcheteur', 3);
        $this->db->update('acheteur');
    }







    public function enregistrePrix($nouveauPrix, $idlot)
    {
      $this->db->set('prixActuel', $nouveauPrix);
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




    public function recupEnchere()
    {
        $sql20=$this->db->conn_id->prepare("UPDATE lot SET codeEtat = 'en cours' ORDER BY `IdLot` DESC LIMIT 1");
        $sql20->execute();
        $etatEnchere=$sql20->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $etatEnchere;
    }

/* ----- FONCTIONS ETAT : Permettent de mettre en place la qualité en direct ----- */

      public function etatEnchere($gmdate)
    {
      $this->db->set('codeEtat', 'terminé');
      $this->db->where('dateHeureFin <', $gmdate);
      $this->db->where('codeEtat !=', 'accepté');
      $this->db->update('lot');
    }

    public function etatEnchereProg($gmdate)
    {
      $this->db->set('codeEtat', 'en cours');
      $this->db->where('dateEnchere <', $gmdate);
      $this->db->where('dateHeureFin >', $gmdate);
      $this->db->update('lot');
    }
    public function etatQualiteOriginal($etatq0)
    {
        $this->db->set('IdQualite', 'or');
        $this->db->where('nbreJourLot =', $etatq0 );
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

    public function suppressionLot($unIdLot)
    {
        $this->db->where('IdLot', $unIdLot);
        $this->db->delete('lot');
       // $this->db->insert('lot', $tab);
    }

    public function validationLot($unIdLot)
    {
      $this->db->set('codeEtat', 'accepté');
      $this->db->where('IdLot', $unIdLot);
      $this->db->update('lot');
        // $this->db->insert('facture', $facture);
    }
 // ----- MISE EN PLACE DU CHAT - TROISIEME VERSION OK ----- //
     public function recupMessage()
    {
         $sql1=$this->db->conn_id->prepare ("SELECT login, minichat.message, minichat.dateHeure FROM acheteur, minichat WHERE minichat.IdAcheteur = acheteur.IdAcheteur AND minichat.message  <> '' ORDER BY id DESC LIMIT 0, 10");
         $sql1->execute();
         $recupMessage=$sql1->fetchAll();
         return $recupMessage;
    }

    public function insertMessage($loginAcheteur, $mesMessages)
     {
       $this->db->select('IdAcheteur')
       ->from('acheteur')
       ->where('login', $loginAcheteur);
       $query = $this->db->get();
       foreach($query->result() as $row)
       {
         //   $dateDuJour = date('Y-m-d');
            $IdAcheteur = $row->IdAcheteur;
            $this->db->set('IdAcheteur', $IdAcheteur);


         //   $this->db->where('id', $id);
      //      $this->db->where('id', $id);
           // $this->db->update('minichat');

       }
       $this->db->insert('minichat', $mesMessages);
   }




   public function factures($IdFacture, $idlot)
   {

 //   $this->db->insert('facture', $IdFacture);
     $this->db->set('IdFacture', $IdFacture);
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
    $this->db->set('IdAcheteur', $IdAcheteur);
    $this->db->where('IdLot', $idlot);
    $this->db->update('lot');
    }
}
 // ----- MISE EN PLACE DU CHAT - DEUXIEME VERSION OK -----
  /*  public function recupMessage()
    {
         $sql1=$this->db->conn_id->prepare ("SELECT login, message FROM acheteur WHERE message <> '' ORDER BY login DESC LIMIT 0, 10");
         $sql1->execute();
         $recupMessage=$sql1->fetchAll();
         return $recupMessage;
    }

    public function insertMessage($mesMessages)
   {
    $this->db->insert('acheteur', $mesMessages);
   }*/

/* ----- MISE EN PLACE DU CHAT - PREMIERE VERSION OK -----
   public function recupMessage()
   {
     $sql1=$this->db->conn_id->prepare ("SELECT pseudo, message FROM minichat ORDER BY ID ASC LIMIT 0, 10");
     $sql1->execute();
     $recupMessage=$sql1->fetchAll();
     return $recupMessage;
   }

   public function insertMessage($mesMessages)
   {
    $this->db->insert('minichat', $mesMessages);
   }*/

// ---- AFFICHAGE DES INFOS DE L'UTILISATEUR : PAS OK ----- //
    public function afficheInfoUtilisateur()
    {
         $sql59=$this->db->conn_id->prepare("SELECT rue, numRue, ville, codePostal, numHabilitation FROM acheteur where IdAcheteur = 3");
         $sql59->execute();
         $resultats=$sql59->fetchAll();
         return $resultats;
    }

/*public function afficheInfoUtilisateur()
    {
         $sql44=$this->db->conn_id->prepare("SELECT login, pwd, rue, numRue, ville, codePostal, numHabilitation FROM acheteur WHERE IdAcheteur = 2 ");
        $sql44->execute();
        $infoUser=$sql44->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null2
        return $infoUser;
       /* $this->db->select('rue, numRue, ville, codePostal, numHabilitation');
        $this->db->from('acheteur');
        $this->db->where('login', $login);
        $this->db->where('pwd', $pwd);
        $query = $this->db->get();
        return $query;*/
    // -----  TENTATIVE DE METTRE EN PLACE SYSTEME CHAT PAS TOUCHE -----  //

   /* function add_message($message, $pseudonyme, $guide)
    {
        $data = array(
            'message'   => (string) $message,
            'pseudonyme'  => (string) $pseudonyme,
            'guide'      => (string) $guide,
            'timestamp' => time(),
        );

        $this->db->insert('message', $data);
    }

    function get_messages($timestamp)
    {
        $this->db->where('timestamp >', $timestamp);
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get('message');

        return array_reverse($query->result_array());
    }*/




    // ----- POUBELLE -----  //

  /*  public function relierLot($unefacture)
    {
        $sql26=$this->db->conn_id->prepare("SELECT IdLot FROM lot");
        $sql26->execute();
        $IdLot=$sql26->fetchAll();

        $this->db->set('IdFacture', $unefacture);
        $this->db->where('IdLot', $IdLot);
        $this->db->update('lot');*/
      /*  $this->db->insert('lot', $unefacture);
        $this->db->insert('presentation', $tab);
    }*/

    /*public function recupLibelleFacture()
    {
        $sql38=$this->db->conn_id->prepare("SELECT libelleFacture from facture");
        $sql38->execute();
        $libelleFacture=$sql38->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $libelleFacture;
    }*/
    /*public function validationLot($idfacture)
    {
        $this->db->insert('facture', $idfacture);

    }*/
// $this->db->delete('mytable', array('id' => $id))


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

}
?>
