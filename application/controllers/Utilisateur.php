<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('session');
	$this->load->model('main_model');
}
// La méthode profil qui sera appelé a un paramètre "$id". Dans notre exemple, il vaudra 1.
public function contenu($id) {

	$this->load->database();
	//$this->load->library('session');
	$this->load->helper('url_helper');
	$this->load->helper('form');
	$this->load->view('v_entete');




	switch ($id) {
		case 'catalogue':
			$this->load->view('v_bandeau');
			
		$data['donnees']=$this->main_model->afficheProduits();
		$data['test']=$this->main_model->lesreferences();
		$this->load->view('v_catalogue',$data);
		break;

		case 'enregistrer':
			$this->load->view('v_bandeau');
			$this->load->view('v_enregistrer');
			break;

		case 'panier':
			$this->load->view('v_bandeau');
			$this->load->view('v_panier');
			break;

		case 'connecter':
			$this->load->view('v_bandeau');
		
			$data['login'] = $this->session->userdata('login');
            $this->load->view('v_connecter',$data);
			
            break;
			
		case 'connection':
		
		
           $loginSaisie =$this->input->post('login');
           $pwdSaisie = $this->input->post('pwd');
		   
		   $data['tab']=$this->main_model->userLogin($loginSaisie,$pwdSaisie);
		   if (count($data['tab']) > 0)
		   {
			  // ok bon login/pwd
			$_SESSION['login']= $loginSaisie;
			$_SESSION['pwd']= $pwdSaisie;
			
		   }
		   else{
			   
			   echo "ll";
			   // mauvais login
			   $data['erreur'] = 'Aucun compte ne correspond à vos identifiants ';
			   $this->load->view('v_connecter',$data);
		   }
		   $this->load->view('v_bandeau');
            break;
		case 'deconnecter':
			session_unset();
			session_destroy();
			$this->load->view('v_bandeau');
			$this->load->view('v_accueil');
			break;
			
		case 'admin':
			$this->load->view('v_bandeau');
			$this->load->view('v_admin');
			break;
		default :
			$this->load->view('v_bandeau');
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

	
	
	
	 public function inscription()
        {
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('login', 'Login', 'required');
                $this->form_validation->set_rules('pwd', 'Mot de Passe', 'required');    
                $this->form_validation->set_rules('rue', 'Rue', 'required');
                $this->form_validation->set_rules('numRue', 'NumRue', 'required');
                $this->form_validation->set_rules('ville', 'Ville', 'required');
                $this->form_validation->set_rules('codePostal', 'Code Postal', 'required');
                            

                if ($this->form_validation->run() == FALSE)
                {
                        $this->load->database();
                        $this->load->helper('url_helper');
                        $this->load->helper('form');
                        $this->load->view('v_entete');
                        $this->load->view('v_bandeau');
                        $this->load->view('v_admin');
                }
                else
                {       
                        $this->load->database();
                        $this->load->helper('url_helper');
                        $this->load->helper('form');
                        $this->load->model('main_model');
                        $this->load->view('v_entete');
                        $this->load->view('v_bandeau');
                        $this->load->view('v_enregistrer');

                        $data = array(
                        //nom bdd -> Nom de la variable
                        'login' => $this->input->post('login'),
                        'pwd' => $this->input->post('pwd'),
                        'rue' => $this->input->post('rue'),
                        'numRue' => $this->input->post('numRue'),
                        'ville' => $this->input->post('ville'),
                        'codePostal' => $this->input->post('codePostal')
                        );
                        //Transfering data to Model
                        $this->main_model->enregistreAcheteur($data);
                        $data['message'] = 'Inscription effectuée';
                        //Loading View
                        $this->load->view('v_admin', $data);

                }

        }

}
	
	
	
