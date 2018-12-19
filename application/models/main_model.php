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
        $sql=$this->db->conn_id->prepare ("SELECT nomEspece FROM espece");
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
