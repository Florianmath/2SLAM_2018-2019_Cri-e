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
        $sql=$this->db->conn_id->prepare ("SELECT IdLot, nomBateau, nomEspece, specification, libellePresentation, LibelleQualite, poidsBrutLot, prixDepart, prixEncheresMax, dateEnchere, heureDebutEnchere, codeEtat FROM lot, bateau, espece, peche, taille, presentation, qualite WHERE bateau.IdBateau = lot.IdBateau AND espece.IdEspece = lot.IdEspece AND taille.IdTaille = lot.IdTaille AND presentation.IdPresentation = lot.IdPresentation AND qualite.IdQualite = lot.IdQualite");
        $sql->execute();
        $donnees=$sql->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $donnees;
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

    public function userLogin($login,$pwd)
    {

        return $this->db->select('login,pwd')
                    ->from($this->table)
                    ->where('login', $login)
                    ->where('pwd', $pwd)
                    ->get()
                    ->result();
    }

}

?>
