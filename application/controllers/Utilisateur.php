<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('session');
	$this->load->model('Main_model');
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
 // $dateActuelle = date('Y-m-d H:i:s');
  $retourneDateE = "SELECT dateEnchere from lot where IdLot = 1";
  $dateDuJour = date('Y-m-d H:i');
  $dateActuelle = strtotime($dateDuJour);
  $dateEnchere = strtotime('retourneDateE');
  $gmdate1 = ceil(abs($dateEnchere - $dateActuelle) / 86400);
 // $dateActuelle = strtotime('1st January 2004');
 // $gmdate1 = idate('d', $dateActuelle); // AFFICHERA 1 CAR PREMIER JANVIER 2004
 // $gmdate1 = round((strtotime($dateActuelle) - strtotime($dateEnchere))/(86400)-1); //LIGNE IMPORTANTE A PAS DELETE

    $etatq0 = NULL ;
    $etatq = 0; // Tous les paliers de qualité que l'on s'impose lors de l'update.
    $etatq2 = 5;
    $etatq3 = 10;
    $etatq4 = 15;

   //$taille1 = 10
    //$taille2 = 20;


	switch ($id) {
		case 'catalogue':
		$this->load->view('v_bandeau');
    $this->load->view('v_Identitee');
		$data['donnees']=$this->Main_model->afficheProduits();
    $data['programmee']=$this->Main_model->afficheEnchereProgrammee();
		//$data['test']=$this->Main_model->lesreferences();
    $this->Main_model->etatEnchere($gmdate);
    $data['retourneDateE']=$this->Main_model->afficheDateEnchere();

   // $this->Main_model->nombreLot($gmdate1);  // --- > je travail dessus actuellement


    $this->Main_model->etatQualiteOriginal($etatq); // Fonctions d'états fonctionnelles
    $this->Main_model->etatQualiteBonne($etatq, $etatq2);
    $this->Main_model->etatQualiteMoyenne($etatq2, $etatq3);
    $this->Main_model->etatQualiteMauvaise($etatq3, $etatq4);
   /* $this->Main_model->taillePetite($taille1);
    $this->Main_model->tailleMoyenne($taille1, $taille2);
    $this->Main_model->tailleGrande($taille2);*/

    $this->Main_model->etatEnchereProg($gmdate);
		$this->load->view('v_catalogue',$data);
		break;

		case 'enregistrer':
			$this->load->view('v_bandeau');
      $this->load->view('v_Identitee');
			$this->load->view('v_enregistrer');
			break;

		case 'panier':

			$this->load->view('v_bandeau');
      $data['enchereacceptee']=$this->Main_model->afficheEnchereAcceptee();
      $this->load->view('v_Identitee');

			$this->load->view('v_panier', $data);

     // $this->load->view('chat');
     // $data['recupMessage']=$this->Main_model->recupMessage();
     // $data['acheteur']=$this->Main_model->recupLogin();
			break;

		case 'connecter':
			$this->load->view('v_bandeau');


			$data['login'] = $this->session->userdata('login');
            $this->load->view('v_connecter',$data);

            break;

		case 'connection':

           $loginSaisie = $this->input->post('login');
           $pwdSaisie = $this->input->post('pwd');
    		   $data['tab']=$this->Main_model->userLogin($loginSaisie,$pwdSaisie);
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
            $this->load->view('v_Identitee');

            $data['compte_admin']=$this->Main_model->afficheAdministrateurs();
            $data['compte_utilisateur']=$this->Main_model->afficheUtilisateur();
           // $data['factureLot']=$this->Main_model->validationLot();
            //$data['meilleuracheteur']=$this->Main_model->afficheMeilleurAcheteur();
            $data['acheteur']=$this->Main_model->recupLogin();

            $data['enchereterminee']=$this->Main_model->afficheEnchereTerminee();
      //      $data['libelleFacture']=$this->Main_model->recupLibelleFacture();
           // $data['destruction']=$this->Main_model->destructionLot();
            $data['recupLot']=$this->Main_model->recupLot();
            $this->load->view('v_administrer',$data);
            break;

        case 'histo':
          $data['enchereacceptee']=$this->Main_model->afficheEnchereAcceptee();
          $data['enchereannulee']=$this->Main_model->afficheEnchereAnnulee();
          $this->load->view('v_entete');
          $this->load->view('v_bandeau');
          $this->load->view('v_histo', $data);
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
      $data['bat']=$this->Main_model->recupIdBateau();
      $data['peche']=$this->Main_model->recupDatePeche();
      $data['presentation']=$this->Main_model->recupPresentation();
      $data['taille']=$this->Main_model->recupTaille();
      $data['bac']=$this->Main_model->recupBac();
      $data['acheteur']=$this->Main_model->recupAcheteur();
      $data['qualite']=$this->Main_model->recupQualite();
      $data['espece']=$this->Main_model->recupEspece();
      $data['facture']=$this->Main_model->recupFacture();
      $data['codeEtat']=$this->Main_model->recupEEtat();



      $this->load->view('v_entete');
      $this->load->view('v_bandeau');
      $this->load->view('v_Identitee');
      $this->load->view('v_ajouter', $data);
      break;
    case 'chat':

        //$this->load->view('v_entete');
  //      $this->load->view('v_entete');
  //      $this->load->view('v_bandeau');

        $data['recupMessage']=$this->Main_model->recupMessage();
        $data['acheteur']=$this->Main_model->recupLogin();
        $this->load->view('v_bandeau');
        $this->load->view('v_Identitee');
        $this->load->view('chat', $data);
      break;
    case 'monCompte':

      $this->load->view('v_bandeau');
      $data['resultats']=$this->Main_model->afficheInfoUtilisateur();
      $this->load->view('v_monCompte', $data);

      break;
    case 'modificationAdresse':

      $this->load->view('v_bandeau');
      $data['resultats']=$this->Main_model->afficheInfoUtilisateur();
      $this->load->view('modificationAdresse', $data);
      break;

    case 'conditions_generales':

      $this->load->view('v_bandeau');
      $this->load->view('v_conditions_generales');
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
 //   $this->load->view('chat');

	}

  public function prix()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_accueil');
    $this->load->view('v_finPage');

    $nouveauPrix = $this->input->post('prix');
    $idlot = $this->input->post('numLot');
    $loginAcheteur = $this->input->post('loginAcheteur');
    $IdAcheteur = $this->input->post('IdAcheteur');

    $this->Main_model->enregistrePrix($nouveauPrix, $idlot);
    $this->Main_model->enregistreIdAcheteur($loginAcheteur,  $idlot);
    redirect('utilisateur/contenu/catalogue');
   // $data['acheteur']=$this->Main_model->SelectIdAcheteur($loginAcheteur);
  }

  public function afficheInfoUtilisateur()
  {
    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_accueil');
    $this->load->view('v_finPage');
    $login = $this->input->post('login');
  }

  public function nombreLot()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_accueil');
    $this->load->view('v_finPage');

    $this->Main_model->nombreLot($gmdate1, $IdLot);
    $gmdate1 = $this->input->post('nbreJourLot');
    $IdLot = $this->input->post('IdLot');

    $data['retourneDateE']=$this->Main_model->afficheDateEnchere();
  }
// ----- MISE EN PLACE DU CHAT - TROISIEME VERSION - PAS OK ------
  public function getMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');

    $this->Main_model->insertMessage($insertMessage);
   // $insertMessage->execute(array($_POST['pseudo'], $_POST['message']));
    $data['recupMessage']=$this->Main_model->recupMessage();
  }

  public function insertMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    // $dateHeure = date('Y-m-d H:i:s');
    $mesMessages = array(
      //'id' => $this->input->post('id'),
      'message' => $this->input->post('message'),
      'dateHeure' => date('Y-m-d H:i:s'), // insert avec une constante
     // 'IdAcheteur' => $this->input->post('IdAcheteur')
       );

   // $dateHeure = $this->input->post('dateHeure');
    $loginAcheteur =$this->input->post('loginAcheteur');
    $IdAcheteur = $this->input->post('IdAcheteur');
    //$id = $this->input->post('id');
   // $dateHeure = date('Y-m-d H:i:s');

    $this->Main_model->insertMessage($loginAcheteur, $mesMessages);
    //$this->Main_model->updateHeure($laDateHeure, $id);
    $data['recupMessage']=$this->Main_model->recupMessage();
    $data['acheteur']=$this->Main_model->recupLogin();

  //  $this->load->view('v_bandeau');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_enregistreChat');
    redirect('utilisateur/contenu/chat');


  }

    public function facture()
  {

    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $IdFacture = $this->input->post('IdFacture');
    $idlot = $this->input->post('IdLot');
    //  'libelleFacture'=>$this->input->post('libelleFacture')
    $this->Main_model->factures($IdFacture, $idlot);
    $this->load->view('v_enregistrerBateau');
    $data['recupLot']=$this->Main_model->recupLot();
  }


/* PREMIERE VERSION OK
  public function getMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');

    $this->Main_model->insertMessage($insertMessage);
   // $insertMessage->execute(array($_POST['pseudo'], $_POST['message']));
    $data['recupMessage']=$this->Main_model->recupMessage();
  }

  public function insertMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $mesMessages = array(
      'pseudo' => $this->input->post('pseudo'),
      'message' => $this->input->post('message')
       );
    $this->Main_model->insertMessage($mesMessages);
    $data['recupMessage']=$this->Main_model->recupMessage();
  //  $this->load->view('v_bandeau');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_enregistreChat');


  }*/
//DEUXIEME VERSION OK
 /* public function getMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');

    $this->Main_model->insertMessage($insertMessage);
   // $insertMessage->execute(array($_POST['pseudo'], $_POST['message']));
    $data['recupMessage']=$this->Main_model->recupMessage();
  }

  public function insertMessage()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');
    $mesMessages = array(
      'login' => $this->input->post('login'),
      'message' => $this->input->post('message')
       );
    $this->Main_model->insertMessage($mesMessages);
    $data['recupMessage']=$this->Main_model->recupMessage();
    $data['acheteur']=$this->Main_model->recupLogin();
  //  $this->load->view('v_bandeau');
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_enregistreChat');


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
            $data['bat']=$this->Main_model->recupIdBateau();
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
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            //nom bdd -> Nom de la variable
            'IdBateau' => $this->input->post('IdBateau'),
            'nomBateau' => $this->input->post('nomBateau'),
            'immatriculationBateau' => $this->input->post('immatriculationBateau')
          );
          $data['bat']=$this->Main_model->recupIdBateau();

          $this->Main_model->enregistreBateau($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }
  }

  public function modificationRue()
  {

            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerModificationCompte');


          $rue = $this->input->post('rue');


          $data['resultats']=$this->Main_model->afficheInfoUtilisateur();

          $this->Main_model->enregistreNouvelleRue($rue);

          //chargement de la View
           $this->load->view('v_monCompte', $data);
          $this->load->view('v_finPage');
          redirect('utilisateur/contenu/monCompte');
  }

  public function modificationNumRue()
  {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerModificationCompte');


          $numRue = $this->input->post('numRue');

          $data['resultats']=$this->Main_model->afficheInfoUtilisateur();

          $this->Main_model->enregistreNouvelleNumRue($numRue);

          //chargement de la View
          $this->load->view('v_monCompte', $data);
          $this->load->view('v_finPage');
          redirect('utilisateur/contenu/monCompte');
  }

  public function modificationVille()
  {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerModificationCompte');


          $ville = $this->input->post('ville');

          $data['resultats']=$this->Main_model->afficheInfoUtilisateur();

          $this->Main_model->enregistreNouvelleVille($ville);

          //chargement de la View
           $this->load->view('v_monCompte', $data);
          $this->load->view('v_finPage');
          redirect('utilisateur/contenu/monCompte');
  }

  public function modificationCodePostal()
  {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerModificationCompte');


          $codePostal = $this->input->post('codePostal');

          $data['resultats']=$this->Main_model->afficheInfoUtilisateur();

          $this->Main_model->enregistreNouvelleCodepostal($codePostal);

          //chargement de la View
           $this->load->view('v_monCompte', $data);
          $this->load->view('v_finPage');
          redirect('utilisateur/contenu/monCompte');
  }

  public function modificationNumHabilitation()
  {
            $this->load->database();
            $this->load->helper('url_helper');
            $this->load->helper('form');
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerModificationCompte');


          $numHabilitation = $this->input->post('numHabilitation');

          $data['resultats']=$this->Main_model->afficheInfoUtilisateur();

          $this->Main_model->enregistreNouvelleNumHabilitation($numHabilitation);

          //chargement de la View
           $this->load->view('v_monCompte', $data);
          $this->load->view('v_finPage');
          redirect('utilisateur/contenu/monCompte');
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
            $data['bat']=$this->Main_model->recupIdBateau();
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
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            //nom bdd -> Nom de la variable
            'IdEspece' => $this->input->post('IdEspece'),
            'nomEspece' => $this->input->post('nomEspece'),
            'nomCommunEspece' => $this->input->post('nomCommunEspece')
          );
          $data['bat']=$this->Main_model->recupIdBateau();

          $this->Main_model->enregistreEspece($tab);
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
            $data['bat']=$this->Main_model->recupIdBateau();
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
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            'IdBateau' => $this->input->post('IdBateau'),
            'datePeche' => $this->input->post('datePeche')
          );
          $data['bat']=$this->Main_model->recupIdBateau();

          $this->Main_model->enregistrePeche($tab);
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
            $data['bat']=$this->Main_model->recupIdBateau();
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
            $this->load->model('Main_model');
            $this->load->view('v_entete');
            $this->load->view('v_bandeau');
            $this->load->view('v_enregistrerBateau');


            $tab = array(
            'IdPresentation' => $this->input->post('IdPresentation'),
            'libellePresentation' => $this->input->post('libellePresentation'),
            'IdEspece' => $this->input->post('IdEspece')
          );
          $data['bat']=$this->Main_model->recupIdBateau();
          $data['espece']=$this->Main_model->recupEspece();

          $this->Main_model->enregistrePresentation($tab);
          //chargement de la View
          $this->load->view('v_ajouter', $data);
          $this->load->view('v_finPage');
    }

  }

  public function suppressionLot()
  {

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');

    $unIdlot = $this->input->get('IdLot');
    $this->Main_model->suppressionLot($unIdlot);
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_enregistrerBateau');
    $this->load->view('v_finPage');
   // $this->load->view('v_administrer');
    $data['recupLot']=$this->Main_model->recupLot();
    redirect('utilisateur/contenu/administrer');
    
  }
  public function validationLot()
  {

    $this->load->database();
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->model('Main_model');

    // $facture = array(
    //   'IdFacture' => $this->input->post('IdFacture'),
    //   'libelleFacture' => $this->input->post('libelleFacture')
    //   );
    $unIdlot = $this->input->get('IdLot');
    $this->Main_model->validationLot($unIdlot);
    $this->load->view('v_entete');
    $this->load->view('v_bandeau');
    $this->load->view('v_enregistrerBateau');
    $this->load->view('v_finPage');
    $data['recupLot']=$this->Main_model->recupLot();
    redirect('utilisateur/contenu/administrer');
  }



  public function enregistreLot()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

 //   $this->form_validation->set_rules('IdLot', 'Id du lot', 'required');
    $this->form_validation->set_rules('IdBateau', "Id du bateau", 'required');
    $this->form_validation->set_rules('datePeche', "date de peche", 'required');
    $this->form_validation->set_rules('IdEspece', "Id de l'espèce", 'required');
    $this->form_validation->set_rules('IdTaille', "Id de la taille", 'required');
    $this->form_validation->set_rules('IdPresentation', "Id la présentation", 'required');
    $this->form_validation->set_rules('IdBac', "Id du bac", 'required');
  //  $this->form_validation->set_rules('IdAcheteur', "Id de l'acheteur", 'required');
    $this->form_validation->set_rules('IdQualite', "Id de la qualité", 'required');
  //  $this->form_validation->set_rules('IdFacture', 'ID de la facture', 'required');

    $this->form_validation->set_rules('poidsBrutLot', 'Le poids brut', 'required');
    $this->form_validation->set_rules('prixPlancher', 'Le prix plancher', 'required');
    $this->form_validation->set_rules('prixDepart', 'Le prix départ', 'required');
    $this->form_validation->set_rules('prixActuel', 'Le prix actuel', 'required');
    $this->form_validation->set_rules('prixEncheresMax', 'Le prix enchere max', 'required');
    $this->form_validation->set_rules('dateEnchere', 'La date enchere', 'required');
    $this->form_validation->set_rules('dateHeureFin', 'La date heure fin', 'required');

    if ($this->form_validation->run() == FALSE)
    {
            $this->load->database();
            $this->load->helper('url_helper');
            $data['bat']=$this->Main_model->recupIdBateau();
            $data['peche']=$this->Main_model->recupDatePeche();
            $data['taille']=$this->Main_model->recupTaille();
            $data['presentation']=$this->Main_model->recupPresentation();
            $data['bac']=$this->Main_model->recupBac();
            $data['acheteur']=$this->Main_model->recupAcheteur();
            $data['qualite']=$this->Main_model->recupQualite();
            $data['espece']=$this->Main_model->recupEspece();
            $data['facture']=$this->Main_model->recupEspece();
            $data['codeEtat']=$this->Main_model->recupEEtat();
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
            $this->load->model('Main_model');
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
         //   'IdLot' => $this->input->post('IdLot'),
            'IdBateau' => $this->input->post('IdBateau'),
            'datePeche' => $this->input->post('datePeche'),
            'IdEspece' => $this->input->post('IdEspece'),
            'IdTaille' => $this->input->post('IdTaille'),
            'IdPresentation' => $this->input->post('IdPresentation'),
            'IdBac' => $this->input->post('IdBac'),
        //    'IdAcheteur' => $this->input->post('IdAcheteur'),
            'IdQualite ' => $this->input->post('IdQualite'),
            'poidsBrutLot' => $this->input->post('poidsBrutLot'),
            'prixPlancher' => $this->input->post('prixPlancher'),
            'prixDepart' => $this->input->post('prixDepart'),
            'prixActuel' => $this->input->post('prixActuel'),
            'prixEncheresMax' => $this->input->post('prixEncheresMax'),
            'dateEnchere' => $this->input->post('dateEnchere'),
            'dateHeureFin' => $this->input->post('dateHeureFin'),
            'codeEtat' => $this->input->post('codeEtat'),
          //  'IdFacture' => $this->input->post('IdFacture')
          );
          $data['bat']=$this->Main_model->recupIdBateau();
          $data['peche']=$this->Main_model->recupDatePeche();
          $data['taille']=$this->Main_model->recupTaille();
          $data['presentation']=$this->Main_model->recupPresentation();
          $data['bac']=$this->Main_model->recupBac();
          $data['acheteur']=$this->Main_model->recupAcheteur();
          $data['qualite']=$this->Main_model->recupQualite();
          $data['espece']=$this->Main_model->recupEspece();
          $data['facture']=$this->Main_model->recupEspece();
          $data['codeEtat']=$this->Main_model->recupEEtat();
          $this->Main_model->enregistreLot($tab);
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
                $this->form_validation->set_rules('cgu', 'CGU', 'required');


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
                        $this->load->model('Main_model');
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
                        'codePostal' => $this->input->post('codePostal'),
                        'cgu' => $this->input->post('cgu'),
                        );
                        //Transfere data au Model
                        $this->Main_model->enregistreAcheteur($data);
                        $data['message'] = 'Inscription effectuée';
                        //chargement de la View
                        $this->load->view('v_admin', $data);

                }

        }

}
