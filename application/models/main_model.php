<?php

class Main_model extends CI_Model {

    /*Private $id;
    Private $nom;
    Private $prenom;*/

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    protected $table = 'client';

    public function afficheProduits(){
        /*
        //Preparation
        $this->load->database();
        $code="aut";
        */
        //Requete
        $sql=$this->db->conn_id->prepare ("SELECT nomEspece FROM espece");
        $sql->execute();
        $donnees=$sql->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $donnees;
    }

    public function lesreferences()
    {
        $sql2=$this->db->conn_id->prepare ('SELECT RefProduit FROM produit');
        $sql2->execute();
        $test=$sql2->fetchAll();//Execution total
        //ferme la connexion
        //$this->db=null;
        return $test;
    }

    public function enregistreClient($data)
    {
            $this->db->insert('client', $data);
    }

    public function userLogin($email,$mdp)
    {

        return $this->db->select('MailClient,MdpClient')
                    ->from($this->table)
                    ->where('MailClient', $email)
                    ->where('MdpClient', $mdp)
                    ->get()
                    ->result();
    }

}

?>
