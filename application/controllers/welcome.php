<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Welcome extends CI_Controller {

        /**
         * Index Page for this controller.
         *
         * Maps to the following URL
         * 		http://example.com/index.php/welcome
         * 	- or -
         * 		http://example.com/index.php/welcome/index
         * 	- or -
         * Since this controller is set as the default controller in
         * config/routes.php, it's displayed at http://example.com/
         *
         * So any other public methods not prefixed with an underscore will
         * map to /index.php/welcome/<method_name>
         * @see http://codeigniter.com/user_guide/general/urls.html
         */

       function __construct(){
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('url');
        }

        public function index() {
                 $this->data['content'] = 'select-form';
                 $this->load->view('index-view', $this->data);
        }
        
        /**testing**/

        public function select_plan() {
                
                 $this->load->helper("form");
                 $this->load->library("form_validation");

                $selected_plan = $this->input->post('plan');
                
                if ($selected_plan == null || $selected_plan === false) {
                        $data['msg'] = "Please Choose a Plan";
                        $this->load->view('after-selection', $data);
                } else {
                        switch ($selected_plan) {
                                case "Plus Individual":
                                $price = "8.95";
                                break;
                                case "Plus Family":
                                $price = "12.95";
                                break;
                                case "Enhanced Individual":
                                $price = "10.95";
                                break;
                                case "Enhanced Family":
                                $price = "14.95";
                                break;
                                case "Unlimited Individual":
                                $price = "13.95";
                                break;
                                case "Unlimited Family":
                                $price = "17.95";
                                break;
                     }


                          $data['msg'] = "Please choose your billing cycle";
                          $this->session->set_userdata('price', $price);
                          $this->session->set_userdata('plan', $selected_plan);
                          $data['content'] = 'enrollment-form';
                          $this->load->view('index-view', $data);
                }
        }

        public function enrollment_form() {

                 $this->form_validation->set_rules('FirstName', 'First Name', 'required');
                 $this->form_validation->set_rules('LastName', 'Last Name', 'required');
                 $this->form_validation->set_rules('DOB', 'Date of Birth', 'required');
                 $this->form_validation->set_rules('Gender', 'Gender', 'required');
                 $this->form_validation->set_rules('Address1', 'Address', 'required');
                 $this->form_validation->set_rules('City', 'City', 'required');
                 $this->form_validation->set_rules('Zip', 'Zipcode', 'required|exact_length[5]|numeric');
                 $this->form_validation->set_rules('Phone', 'Phone', 'required|exact_length[10]|numeric');
                 $this->form_validation->set_rules('Email', 'Email', 'required|valid_email');
                 $this->form_validation->set_rules('PlanOption', 'PlanOption', 'required');
                 $this->form_validation->set_rules('EffectiveDate', 'EffectiveDate', 'required');
                 $this->form_validation->set_rules('PrimaryExternalMemberId', 'PrimaryExternalMemberId', 'required');
                 $this->form_validation->set_rules('Relationship', 'Relationship', 'required');

                        if ($this->form_validation->run() == FALSE)
                        {

                                $this->load->view('enrollment-form');
                        }
                        else
                        {
                                //$this->load->view('enrollment-success');
                                //$this->enroll();
                        }
     }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */