<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('session');
	$this->load->model('main_model');
  date_default_timezone_set('Europe/Paris');
}
// La méthode profil qui sera appelé a un paramètre "$id". Dans notre exemple, il vaudra 1.
public function contenu($id) {

	$this->load->database();
	//$this->load->library('session');
	$this->load->helper('url_helper');
	$this->load->helper('form');
	$this->load->view('v_entete');

  $h = "1";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
  $hm = $h * 60;
  $ms = $hm * 60;
  $gmdate = gmdate("Y-m-d H:i:s", time()+($ms)); // the "-" can be switched to a plus if that's what your time zone is.
  //$dateActuelle  = time();
 //$dateEnchere = 'SELECT lot.dateEnchere FROM lot';
  //$date1 = strtotime($dateEnchere);
  //$dateEnchere = strtotime('dateEnchere');
  //$dateActuelle = date('Y-m-d H:i:s');
  //$gmdate1 = round((strtotime($dateActuelle) - strtotime($dateEnchere))/(86400)-1); LIGNE IMPORTANTE A PAS DELETE

    $etatq = 0; // Tous les paliers de qualité que l'on s'impose lors de l'update. 
    $etatq2 = 5;
    $etatq3 = 10;
    $etatq4 = 15;

   //$taille1 = 10;
    //$taille2 = 20;
 
 
	switch ($id) {
		case 'catalogue':
			$this->load->view('v_bandeau');
		$data['donnees']=$this->main_model->afficheProduits();
    $data['programmee']=$this->main_model->afficheEnchereProgrammee();
		$data['test']=$this->main_model->lesreferences();
    $this->main_model->etatEnchere($gmdate);
   // $this->main_model->nombreLot($gmdate1);   --- > je travail dessus actuellement 



    $this->main_model->etatQualiteOriginal($etatq); // Fonctions d'états fonctionnelles 
    $this->main_model->etatQualiteBonne($etatq, $etatq2);
    $this->main_model->etatQualiteMoyenne($etatq2, $etatq3);
    $this->main_model->etatQualiteMauvaise($etatq3, $etatq4);
   /* $this->main_model->taillePetite($taille1);
    $this->main_model->tailleMoyenne($taille1, $taille2);
    $this->main_model->tailleGrande($taille2);*/

    $this->main_model->etatEnchereProg($gmdate);
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
			$this->load->view('v_bandeau');

			$this->load->view('v_accueil');

		   }
		   else{
         $this->load->view('v_bandeau');
			   //echo "ll";
			   // mauvais login
			   $data['erreur'] = 'Aucun compte ne correspond à vos identifiants ';
			   $this->load->view('v_connecter',$data);
		   }


            break;

        case 'administrer':
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');

            $data['compte_admin']=$this->main_model->afficheAdministrateurs();
            $data['compte_utilisateur']=$this->main_model->afficheUtilisateur();
            //$data['meilleuracheteur']=$this->main_model->afficheMeilleurAcheteur();
            $data['enchereterminee']=$this->main_model->afficheEnchereTerminee();
            

            $this->load->view('v_administrer',$data);
            break;
		case 'deconnecter':
			session_unset();
			session_destroy();
			$this->load->view('v_bandeau');
			$this->load->view('v_accueil');
			break;

		case 'admin':
      $this->load->view('v_entete');
			$this->load->view('v_bandeau');
			$this->load->view('v_admin');
			break;

    case 'ajouter':
      $data['bat']=$this->main_model->recupIdBateau();
      $data['peche']=$this->main_model->recupDatePeche();
      $data['presentation']=$this->main_model->recupPresentation();
      $data['taille']=$this->main_model->recupTaille();
      $data['bac']=$this->main_model->recupBac();
      $data['acheteur']=$this->main_model->recupAcheteur();
      $data['qualite']=$this->main_model->recupQualite();
      $data['espece']=$this->main_model->recupEspece();



      $this->load->view('v_entete');
      $this->load->view('v_bandeau');
      $this->load->view('v_ajouter', $data);
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

  public function prix()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('main_model');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_accueil');
    $this->load->view('v_finPage');

    $nouveauPrix = $this->input->post('prix');
    $idlot = $this->input->post('numLot');

    $this->main_model->enregistrePrix($nouveauPrix, $idlot);
    $data['message'] = 'Offre prise en compte';


  }
  /*public function dateEnchere()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('main_model');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_accueil');
    $this->load->view('v_finPage');
    $nouveauPrix = $this->input->post('prix');  
    $this->main_model->enregistreDateEnchere($nouvelleDate);
    foreach ($donnees as $row ) {
    $dateEnchere1 = $row["dateEnchere"] + 1;
    }
  }*/


  public function enregistreBateau()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdBateau', 'Id du bateau', 'required');
    $this->form_validation->set_rules('nomBateau', 'Nom du bateau', 'required');
    $this->form_validation->set_rules('immatriculationBateau', 'immatriculation du bateau', 'required');

    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $data['bat']=$this->main_model->recupIdBateau();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_ajouter', $data);
            $this->load->view('v_finPage');

    }
    else
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            //nom bdd -> Nom de la variable
            'IdBateau' => $this->input->post('IdBateau'),
            'nomBateau' => $this->input->post('nomBateau'),
            'immatriculationBateau' => $this->input->post('immatriculationBateau')
          );
          $data['bat']=$this->main_model->recupIdBateau();

          $this->main_model->enregistreBateau($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }
  }

  public function enregistreEspece() 
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdEspece', 'Id de l\'espece', 'required');
    $this->form_validation->set_rules('nomEspece', 'Nom de l\'espece', 'required');
    $this->form_validation->set_rules('nomCommunEspece', 'Nom commun de l\'espece', 'required');

    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $data['bat']=$this->main_model->recupIdBateau();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_ajouter', $data);
            $this->load->view('v_finPage');

    }
    else
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            //nom bdd -> Nom de la variable
            'IdEspece' => $this->input->post('IdEspece'),
            'nomEspece' => $this->input->post('nomEspece'),
            'nomCommunEspece' => $this->input->post('nomCommunEspece')
          );
          $data['bat']=$this->main_model->recupIdBateau();

          $this->main_model->enregistreEspece($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }
  }

  public function enregistrePeche()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdBateau', 'Id du bateau', 'required');
    $this->form_validation->set_rules('datePeche', 'Date de la pêche', 'required');

    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $data['bat']=$this->main_model->recupIdBateau();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_ajouter', $data);
            $this->load->view('v_finPage');
    }
    else
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            'IdBateau' => $this->input->post('IdBateau'),
            'datePeche' => $this->input->post('datePeche')
          );
          $data['bat']=$this->main_model->recupIdBateau();

          $this->main_model->enregistrePeche($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }
  }

  public function enregistrePresentation()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdPresentation', 'Id de la présentation', 'required');
    $this->form_validation->set_rules('libellePresentation', 'Libellé de la présentation', 'required');
    $this->form_validation->set_rules('IdEspece', "Id de l'espèce", 'required');

    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $data['bat']=$this->main_model->recupIdBateau();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_ajouter', $data);
            $this->load->view('v_finPage');
    }
    else
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            'IdPresentation' => $this->input->post('IdPresentation'),
            'libellePresentation' => $this->input->post('libellePresentation'),
            'IdEspece' => $this->input->post('IdEspece')
          );
          $data['bat']=$this->main_model->recupIdBateau();
          $data['espece']=$this->main_model->recupEspece();

          $this->main_model->enregistrePresentation($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }

  }

  public function enregistreLot()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $this->form_validation->set_rules('IdLot', 'Id du lot', 'required');
    $this->form_validation->set_rules('IdBateau', "Id du bateau", 'required');
    $this->form_validation->set_rules('datePeche', "date de peche", 'required');
    $this->form_validation->set_rules('IdEspece', "Id de l'espèce", 'required');
    $this->form_validation->set_rules('IdTaille', "Id de la taille", 'required');
    $this->form_validation->set_rules('IdPresentation', "Id la présentation", 'required');
    $this->form_validation->set_rules('IdBac', "Id du bac", 'required');
    $this->form_validation->set_rules('IdAcheteur', "Id de l'acheteur", 'required');
    $this->form_validation->set_rules('IdQualite', "Id de la qualité", 'required');
   
    $this->form_validation->set_rules('poidsBrutLot', 'Le poids brut', 'required');
    $this->form_validation->set_rules('prixPlancher', 'Le prix plancher', 'required');
    $this->form_validation->set_rules('prixDepart', 'Le prix départ', 'required');
    $this->form_validation->set_rules('prixActuel', 'Le prix actuel', 'required');
    $this->form_validation->set_rules('prixEncheresMax', 'Le prix enchere max', 'required');
    $this->form_validation->set_rules('dateEnchere', 'La date enchere', 'required');
    $this->form_validation->set_rules('dateHeureFin', 'La date heure fin', 'required');
    $this->form_validation->set_rules('IdFacture', 'ID de la facture', 'required');
    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $data['bat']=$this->main_model->recupIdBateau();
            $data['peche']=$this->main_model->recupDatePeche();
            $data['taille']=$this->main_model->recupTaille();
            $data['presentation']=$this->main_model->recupPresentation();
            $data['bac']=$this->main_model->recupBac();
            $data['acheteur']=$this->main_model->recupAcheteur();
            $data['qualite']=$this->main_model->recupQualite();
            $data['espece']=$this->main_model->recupEspece();
            $this->load->helper('form');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_ajouter', $data);
            $this->load->view('v_finPage');
    }
    else
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');

           /* $req->execute(array(
            'IdLot' => $IdLot,
            'poidsBrutLot' => $poidsBrutLot,
            'prixPlancher' => $prixPlancher,
            'prixActuel' => $prixActuel,
            'prixEncheresMax' => $prixEncheresMax,
            'dateEnchere' => $dateEnchere,
            'dateHeureFin' => $dateHeureFin,
            'codeEtat' => $codeEtat,
            'IdFacture' => $IdFacture
            ));*/
            $tab = array(
            'IdLot' => $this->input->post('IdLot'),
            'IdBateau' => $this->input->post('IdBateau'),
            'datePeche' => $this->input->post('datePeche'),
            'IdEspece' => $this->input->post('IdEspece'),
            'IdTaille' => $this->input->post('IdTaille'),
            'IdPresentation' => $this->input->post('IdPresentation'),
            'IdBac' => $this->input->post('IdBac'),
            'IdAcheteur' => $this->input->post('IdAcheteur'),
            'IdQualite ' => $this->input->post('IdQualite'),
            'poidsBrutLot' => $this->input->post('poidsBrutLot'),
            'prixPlancher' => $this->input->post('prixPlancher'),
            'prixDepart' => $this->input->post('prixDepart'),
            'prixActuel' => $this->input->post('prixActuel'),
            'prixEncheresMax' => $this->input->post('prixEncheresMax'),
            'dateEnchere' => $this->input->post('dateEnchere'),
            'dateHeureFin' => $this->input->post('dateHeureFin'),
            'IdFacture' => $this->input->post('IdFacture')
          );
          $data['bat']=$this->main_model->recupIdBateau();
          $data['peche']=$this->main_model->recupDatePeche();
          $data['taille']=$this->main_model->recupTaille();
          $data['presentation']=$this->main_model->recupPresentation();
          $data['bac']=$this->main_model->recupBac();
          $data['acheteur']=$this->main_model->recupAcheteur();
          $data['qualite']=$this->main_model->recupQualite();
          $data['espece']=$this->main_model->recupEspece();
          $this->main_model->enregistreLot($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }
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
                        $this->load->view('v_finPage');
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
                        // Bug à régler : "la fin de page se tire !" $this->load->view('v_finPage');
                        $this->load->view('v_finPage');

                        $data = array(
                        //nom bdd -> Nom de la variable
                        'login' => $this->input->post('login'),
                        'pwd' => $this->input->post('pwd'),
                        'rue' => $this->input->post('rue'),
                        'numRue' => $this->input->post('numRue'),
                        'ville' => $this->input->post('ville'),
                        'codePostal' => $this->input->post('codePostal')
                        );
                        //Transfere data au Model
                        $this->main_model->enregistreAcheteur($data);
                        $data['message'] = 'Inscription effectuée';
                        //chargement de la View
                        $this->load->view('v_admin', $data);

                }

        }

}
