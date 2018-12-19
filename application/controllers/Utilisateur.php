<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->sessionUser();
}
// La méthode profil qui sera appelé a un paramètre "$id". Dans notre exemple, il vaudra 1.
public function contenu($id) {

	$this->load->database();
	//$this->load->library('session');
	$this->load->helper('url_helper');
	$this->load->helper('form');
	$this->load->view('v_entete');
	$this->load->view('v_bandeau');



	switch ($id) {
		case 'catalogue':
		$this->load->model('main_model');
		$data['donnees']=$this->main_model->afficheProduits();
		$data['test']=$this->main_model->lesreferences();
		$this->load->view('v_catalogue',$data);
		break;

		case 'enregistrer':
			$this->load->view('v_enregistrer');
			break;

		case 'panier':
			$this->load->view('v_panier');
			break;

		case 'connecter':
            $this->load->view('v_connecter');
            break;

		case 'admin':
			$this->load->view('v_admin');
			break;
		default :
			$this->load->view('v_accueil');
		}
		$this->load->view('v_finPage');

}

	public function index()
	{
		$this->load->helper('url_helper');
		$this->load->view('v_entete');
		$this->load->view('v_bandeau');
		$this->load->view('v_accueil');
		$this->load->view('v_finPage');

	}

	private function sessionUser() {
    if (!$this->session->userdata('id_user'))
    	{
    		$this->load->helper('url_helper');
    	}
	}

	public function logout()
	{

	   	$this->session->sess_destroy();
	    $this->load->view('v_accueil');
	}

}
	class Login extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function index(){

        //Récupérer les données saisies envoyées en POST
        $email = $this->input->post('email');
        $mdp = $this->input->post('mdp');


        $this->form_validation->set_rules('email', '"Identifiant"', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'trim|required|xss_clean');
        $result = $this->main_model->userLogin($email,$mdp);

        if($this->form_validation->run() == false)
        {
            $this->load->view('utilisateur/contenu/catalogue');
        }
        elseif($this->form_validation->run() == true && empty($result))
        {
            $this->session->set_flashdata('noconnect', 'Aucun compte ne correspond à vos identifiants ');
            redirect('utilisateur/contenu/catalogue');
        }
        else
        {
           $this->session->set_userdata('id_user', $result[0]->id_user);
           redirect('utilisateur/contenu/catalogue');
        }
        }
    }
