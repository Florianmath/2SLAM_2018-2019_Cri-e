<?php

class Form extends CI_Controller {

        public function index()
        {
                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');

                $this->form_validation->set_rules('nom', 'Nom', 'required');
                $this->form_validation->set_rules('prenom', 'Prenom', 'required');
                $this->form_validation->set_rules('adresse', 'Adresse', 'required');
                $this->form_validation->set_rules('ville', 'Ville', 'required');
                $this->form_validation->set_rules('cp', 'Code Postal', 'required');
                $this->form_validation->set_rules('tel', 'Telephone', 'required');
                $this->form_validation->set_rules('mail', 'Email', 'required');
                $this->form_validation->set_rules('pwd', 'Mot de Passe', 'required');                

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
                        'NomClient' => $this->input->post('nom'),
                        'PrenomClient' => $this->input->post('prenom'),
                        'AdresseClient' => $this->input->post('adresse'),
                        'VilleClient' => $this->input->post('ville'),
                        'CPClient' => $this->input->post('cp'),
                        'TelClient' => $this->input->post('tel'),
                        'MailClient' => $this->input->post('mail'),
                        'MdpClient' => $this->input->post('pwd')
                        );
                        //Transfering data to Model
                        $this->main_model->enregistreClient($data);
                        $data['message'] = 'Inscription effectuée';
                        //Loading View
                        $this->load->view('v_admin', $data);

                }

        }
}