<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Enroll extends CI_Controller {
    
           function __construct()
          {
                parent::__construct();
                $this->load->library('ameridoc');
               $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
$this->output->set_header("Pragma: no-cache");
          }
    
            public function index() {
                 $this->data['content'] = 'select-form';
                 $this->load->view('index-view', $this->data);
        }
        
        public function select_plan() {
            $this->form_validation->set_rules('plan', 'Plan', 'required|xss_clean');
            
              if ($this->form_validation->run() == true)
             {
                   $selected_plan = $this->input->post('plan');
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
                    // Add the price to the session
                    $this->session->set_userdata('price', $price);
                  //Display enrollment form
                  redirect("enroll/enroll_info");
              } else {
                  //redirect to CMS MADE SIMPLE
                  echo "go back and fill out form";
              }
            
        }
        
        
          private function get_enroll_form ($post)
        {
              

            if (validation_errors()) {
                $this->data['message'] = validation_errors();
            } else {
                                 $this->data['message'] = $this->session->flashdata('message');   
                       }
           

             // $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                    $this->data['formattributes'] = array('id' =>'enrollment');
                    
                    // IF THE POST_DATA ARRAY EXISTS IN A SESSION, SET ITS VALUE IN THE POST_DATA VARIABLE
                    $post_data = ($this->session->userdata('post_data'))?  $this->session->userdata('post_data') : '';
                    ///SET POST DATA UP TO BE SENT TO VIEW FOR THE DROPDOWN LISTS TO DISPLAY EXISTING INFORMATION
                    $this->data['post_data'] = $post_data;  
                    
                    
                    $this->data['special'] = array(
                      'type' => 'text', 
                      'name' => 'formrequired', 
                      'id' =>'special'
                    );
                      
                    $FirstName = (isset($post_data['FirstName']))? $post_data['FirstName'] : $this->form_validation->set_value('FirstName');
                   $this->data['FirstName'] = array(
                      'name' =>'FirstName',
                       'id'=>'FirstName',
                       'class' => 'required',
                       'type'=>'text',
                       'value'=> $FirstName
                   );

                   $LastName = (isset($post_data['LastName']))? $post_data['LastName'] : $this->form_validation->set_value('LastName');
                   $this->data['LastName'] = array(
                      'name' =>'LastName',
                       'id'=>'LastName',
                       'class' => 'required',
                       'type'=>'text',
                       'value'=>$LastName
                   );

            
                   $DOB = (isset($post_data['DOB']))? $post_data['DOB'] : $this->form_validation->set_value('DOB');
                   $this->data['DOB'] = array(
                      'name' =>'DOB',
                       'id'=>'DOB',
                       'class' => 'required',
                       'type'=>'text',
                       'value'=>  $DOB
                   );

                    $this->data['gender_list'] = array(
                          '' => "--Select--",
                         'M'=>'Male',
                        'F'=>'Female'
                   );

                    $Address1 = (isset($post_data['Address1']))? $post_data['Address1'] : $this->form_validation->set_value('Address1');
                     $this->data['Address1'] = array(
                      'name' =>'Address1',
                       'id'=>'Address1',
                       'class'=>'required',
                       'type'=>'text',
                       'value'=>$Address1
                   );

                     $Address2 = (isset($post_data['Address2']))? $post_data['Address2'] : $this->form_validation->set_value('Address2');
                      $this->data['Address2'] = array(
                      'name' =>'Address2',
                       'id'=>'Address2',
                       'type'=>'text',
                       'value'=>$Address2
                   );

                      $City = (isset($post_data['City']))? $post_data['City'] : $this->form_validation->set_value('City');
                       $this->data['City'] = array(
                      'name' =>'City',
                       'id'=>'City',
                       'class'=>'required',
                       'type'=>'text',
                       'value'=>$City
                   );

                       
                      $this->data['state_list'] =
                              array(
                                  '' => "--Select--",
                                  'AL'=>"Alabama",
			'AK'=>"Alaska",
			'AZ'=>"Arizona",
			'AR'=>"Arkansas",
			'CA'=>"California",
			'CO'=>"Colorado",
			'CT'=>"Connecticut",
			'DE'=>"Delaware",
			'DC'=>"District Of Columbia",
			'FL'=>"Florida",
			'GA'=>"Georgia",
			'HI'=>"Hawaii",
			'ID'=>"Idaho",
			'IL'=>"Illinois",
			'IN'=>"Indiana",
			'IA'=>"Iowa",
			'KS'=>"Kansas",
			'KY'=>"Kentucky",
			'LA'=>"Louisiana",
			'ME'=>"Maine",
			'MD'=>"Maryland",
			'MA'=>"Massachusetts",
			'MI'=>"Michigan",
			'MN'=>"Minnesota",
			'MS'=>"Mississippi",
			'MO'=>"Missouri",
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",
			'OK'=>"Oklahoma",
			'OR'=>"Oregon",
			'PA'=>"Pennsylvania",
			'RI'=>"Rhode Island",
			'SC'=>"South Carolina",
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",
			'TX'=>"Texas",
			'UT'=>"Utah",
			'VT'=>"Vermont",
			'VA'=>"Virginia",
			'WA'=>"Washington",
			'WV'=>"West Virginia",
			'WI'=>"Wisconsin",
			'WY'=>"Wyoming");

                      $Zip = (isset($post_data['Zip']))? $post_data['Zip'] : $this->form_validation->set_value('Zip');
                      $this->data['Zip'] = array(
                      'name' =>'Zip',
                       'id'=>'Zip',
                       'class'=>'required digits',
                       'type'=>'text',
                       'value'=>$Zip
                   );

                      $Phone = (isset($post_data['Phone']))? $post_data['Phone'] : $this->form_validation->set_value('Phone');
                       $this->data['Phone'] = array(
                      'name' =>'Phone',
                       'id'=>'Phone',
                       'class' => 'required phone',
                       'type'=>'text',
                       'value'=>$Phone
                   );

                       $Email = (isset($post_data['Email']))? $post_data['Email'] : $this->form_validation->set_value('Email');
                        $this->data['Email'] = array(
                      'name' =>'Email',
                       'id'=>'Email',
                       'class'=>'email',
                       'type'=>'text',
                       'value'=>$Email
                   );

                      $this->data['plan_list'] = array(
                            '' => "--Select--",
                        '1'=> 'Individual',
                        '2'=>'Individual + Family',
                        '3'=>'Individual + Spouse',
                        '4'=>'Individual + Children'
                      );

                      /*
                          $this->data['EffectiveDate'] = array(
                      'name' =>'EffectiveDate',
                       'id'=>'EffectiveDate',
                       'type'=>'text',
                       'value'=>$this->form_validation->set_value('EffectiveDate')
                   );*/

                           $this->data['relationship_list'] = array(
                                 '' => "--Select--",
                             '0'=>'Self',
                             '1'=>'Husband',
                             '2'=>'Wife',
                             '3'=>'Son',
                            '4'=>'Daughter',
                             '5'=>'Other',
                             '6'=>'Unknown'

                   );
                           $checked = false;
                           
                           $is_dependent = ($this->session->userdata('is_dependent'))?  $this->session->userdata('is_dependent') : '';
                           if (isset($post['is_dependent'])) 
                              {
                                       if(in_array('yes', $post['is_dependent'])) 
                                           {
                                               $checked = true;
                                           }
                               } elseif ($is_dependent) 
                               
                               {
                                       if(in_array('yes', $is_dependent)) 
                                           {
                                                $checked = true;
                                           }
                               }

              
                       $this->data['is_dependent'] = array(
                           'name' => 'is_dependent[]',
                           'id' =>'is_dependent',
                           'value'=>'yes',
                           'checked' => $checked
                       );

                       // IF THE USER SELECTED YES FOR "IS DEPENDENT" FIELD BEFORE, FILL THIS VALUE WITH THE PrimaryExtMemId (IF IT IS SET)
                       // ELSE SET IT AS set_value....
                       $PrimaryExternalMemberId = ($is_dependent)? $post_data['PrimaryExternalMemberId']  :  $this->form_validation->set_value('PrimaryExternalMemberId') ;
                
                      $this->data['PrimaryExternalMemberId'] = array(
                      'name' =>'PrimaryExternalMemberId',
                       'id'=>'PrimaryExternalMemberId',
                       'type'=>'text',
                       'value'=>$PrimaryExternalMemberId
                   );

        }
        
        private function get_payment_form($post) {
                 if (validation_errors()) {
                $this->data['message'] = validation_errors();
                } else {
                    $this->data['message'] = $this->session->flashdata('message');
                
                }
                
                 $this->data['formattributes'] = array('id' =>'enrollment');
                
                 /*
                $checked = false;
                           if (isset($post['sameAs'])) {
                               if(in_array('yes', $post['sameAs'])) {
                       
                                   $checked = true;
                               }
                           }*/
                  
                
                $this->data['sameAs'] = array (
                    'name' => 'sameAs',
                    'id' => 'sameAs',
                    'value'=>'yes',
              
                );
                
                $this->data['special'] = array(
                      'type' => 'text', 
                      'name' => 'formrequired', 
                      'id' =>'special'
                    );
                
                  $this->data['bill_first_name'] = array(
                      'name' => 'bill_first_name',
                      'id' =>'first_name',
                     'type' => 'text',
                      'value' => $this->form_validation->set_value('bill_first_name')
                  );
                  
                  $this->data['bill_last_name'] = array(
                      'name' => 'bill_last_name',
                      'id' =>'last_name',
                      'type' => 'text',
                      'value' => $this->form_validation->set_value('bill_last_name')
                  );
                
                   $this->data['bill_phone'] = array(
                    'name' => 'bill_phone', 
                    'id' => 'phone',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('bill_phone')
                );
                
                $this->data['bill_email'] = array(
                    'name' => 'bill_email',
                    'id' => 'email',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('bill_email')
                );
                
                                     $this->data['bill_address'] = array(
                      'name' =>'bill_address',
                       'id'=>'address',
                       'type'=>'text',
                       'value'=>$this->form_validation->set_value('bill_address')
                   );

                      $this->data['bill_address2'] = array(
                      'name' =>'bill_address2',
                       'id'=>'Address2',
                       'type'=>'text',
                       'value'=>$this->form_validation->set_value('bill_address2')
                   );

                       $this->data['bill_city'] = array(
                      'name' =>'bill_city',
                       'id'=>'City',
                       'type'=>'text',
                       'value'=>$this->form_validation->set_value('bill_city')
                   );

                      $this->data['state_list'] =
                              array(
                                   '' => "--Select--",
                                  'AL'=>"Alabama",
			'AK'=>"Alaska",
			'AZ'=>"Arizona",
			'AR'=>"Arkansas",
			'CA'=>"California",
			'CO'=>"Colorado",
			'CT'=>"Connecticut",
			'DE'=>"Delaware",
			'DC'=>"District Of Columbia",
			'FL'=>"Florida",
			'GA'=>"Georgia",
			'HI'=>"Hawaii",
			'ID'=>"Idaho",
			'IL'=>"Illinois",
			'IN'=>"Indiana",
			'IA'=>"Iowa",
			'KS'=>"Kansas",
			'KY'=>"Kentucky",
			'LA'=>"Louisiana",
			'ME'=>"Maine",
			'MD'=>"Maryland",
			'MA'=>"Massachusetts",
			'MI'=>"Michigan",
			'MN'=>"Minnesota",
			'MS'=>"Mississippi",
			'MO'=>"Missouri",
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",
			'OK'=>"Oklahoma",
			'OR'=>"Oregon",
			'PA'=>"Pennsylvania",
			'RI'=>"Rhode Island",
			'SC'=>"South Carolina",
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",
			'TX'=>"Texas",
			'UT'=>"Utah",
			'VT'=>"Vermont",
			'VA'=>"Virginia",
			'WA'=>"Washington",
			'WV'=>"West Virginia",
			'WI'=>"Wisconsin",
			'WY'=>"Wyoming");

                      $this->data['bill_zip'] = array(
                      'name' =>'bill_zip',
                       'id'=>'Zip',
                       'type'=>'text',
                       'value'=>$this->form_validation->set_value('bill_zip')
                   );
                      
 
                
                
                $this->data['card_num'] = array(
                    'name' => 'card_num',
                    'type' => 'text',
                    'id' => 'card',
                    'value' => $this->form_validation->set_value('card_num')
                );
               
                /*
                $this->data['card_exp'] = array(
                    'name' => 'card_exp',
                    'type' => 'text',
                    'id' => 'exp',
                    'value' => $this->form_validation->set_value('card_exp')
                );*/
                
                
                $this->data['month_list']  = array();
                for ($i = 1; $i <= 12; $i++)
                {
                    $this->data['month_list'][$i] = $i;
                }
                
                $this->data['year_list'] = array();
                $year = date("Y");
                $final_year = $year + 16;
                for ($i = $year; $i <= $final_year; $i++)
                {
                    $this->data['year_list'][$i] = $i;
                }
                
                
                
                $this->data['cvv'] = array(
                    'name' => 'cvv',
                    'type' => 'text',
                    'id' => 'cvv',
                    'value' => $this->form_validation->set_value('cvv')
                );
            
        }
        
        
        
        
        public function enroll_info() {
                 $this->data['title'] = "Enroll";
                 $this->form_validation->set_rules('FirstName', 'First Name', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('LastName', 'Last Name', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('DOB', 'Date of Birth', 'required|xss_clean|trim|strip_tags|callback_validateDateFormat');
                 $this->form_validation->set_rules('Gender', 'Gender', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('Address1', 'Address', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('City', 'City', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('State', 'State', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('Zip', 'Zipcode', 'required|xss_clean|trim|strip_tags|exact_length[5]|integer');
                 $this->form_validation->set_rules('Phone', 'Phone', 'required|trim|strip_tags|xss_clean|callback_validatePhoneLength');
                 $this->form_validation->set_rules('Email', 'Email', 'trim|strip_tags|valid_email|xss_clean');
                 $this->form_validation->set_rules('PlanOption', 'PlanOption', 'required|trim|xss_clean|integer');
                 //$this->form_validation->set_rules('EffectiveDate', 'EffectiveDate', 'required|xss_clean|callback_validateDateFormat');
                 $this->form_validation->set_rules('PrimaryExternalMemberId', 'PrimaryExternalMemberId', 'xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('Relationship', 'Relationship', 'required|xss_clean|integer');
                 $this->form_validation->set_message('validateDateFormat', 'Please use the mm/dd/yyy date format.');
                 $this->form_validation->set_message('validatePhoneLength', 'Please enter your 10 digit telephone number.');
                 $this->form_validation->set_error_delimiters('<div class="serverror">', '</div>');
                 (isset($_POST['is_dependent'])) ? $this->form_validation->set_rules('PrimaryExternalMemberId', 'PrimaryExternalMemberId', 'required|xss_clean') : $this->form_validation->set_rules('PrimaryExternalMemberId', 'PrimaryExternalMemberId', 'xss_clean');
                 
                      // IF THE VALIDATION PASSES
             if ($this->form_validation->run() == true)
             {
                 // HONEYPOT SPAM FILTER
                 (strlen($_POST['formrequired']) > 0)? exit():'' ;
                 
                  //  WILL NEED TO GENERATE EXTERNAL MEMBER ID  IF ONE WASN'T ALREADY CREATED ON THE LAST SUBMISSION  //
               //  $ExternalMemberId = (!isset($ExternalMemberId)) ? $this->ameridoc->GetRandomMemberId() : $ExternalMemberId;
                 
                 // HOWEVER IF THE EXTERNAL MEMBER ID EXISTS IN THE SESSION, SET THAT VALUE TO $ExternalMemberId
                  $post_data = ($this->session->userdata('post_data'))?  $this->session->userdata('post_data') : '';
                  if ($post_data['ExternalMemberId']) {
                      $ExternalMemberId = $post_data['ExternalMemberId'];
                  } else {
                       $ExternalMemberId = (!isset($ExternalMemberId)) ? $this->ameridoc->GetRandomMemberId() : $ExternalMemberId;
                  }
                 
                  //  IF THE USER IS A DEPENDENT, THEY WILL HAVE FILLED OUT THE PRIMARYEXTMEMID FIELD, OTHERWISE SET IT TO THE EXTERANL MEM ID
                $PrimaryExternalMemberId = (isset($_POST['is_dependent'])) ? $_POST['PrimaryExternalMemberId'] : $ExternalMemberId;
                
                //  Get TODAY'S DATE FOR THE EFFECTIVE DATE REQUIREMENT
                $EffectiveDate = date('m/d/Y');
                
                 $post_data = array(
                            'Key' =>$this->ameridoc->GetKey(),
                            'ExternalMemberId' => $ExternalMemberId,
                            'FirstName' => $_POST['FirstName'],
                            'LastName' => $_POST['LastName'],
                            'DOB' =>$_POST['DOB'],
                            'Gender' => $_POST['Gender'],
                            'Address1' => $_POST['Address1'],
                            'Address2' => $_POST['Address2'],
                            'City' => $_POST['City'],
                            'State' => $_POST['State'],
                            'Zip' => $_POST['Zip'],
                            'Phone' => $_POST['Phone'],
                            'Email' => $_POST['Email'],
                            'GroupNumber' => $this->ameridoc->GetGroupNumber(),
                            'PlanId' => $this->ameridoc->GetPlanId(),
                            'PlanOption' => $_POST['PlanOption'],
                            'EffectiveDate' => $EffectiveDate,
                            'Relationship' => $_POST['Relationship'],
                            'PrimaryExternalMemberId' => $PrimaryExternalMemberId     
                     );
                 
                 // Save the post data to a session
                 $this->session->set_userdata('post_data', $post_data);
                 // Save the is_dependent value in the session
                 $this->session->set_userdata('is_dependent', $_POST['is_dependent']);
                 redirect('signup/payment_portal');
                 
             } else {
                  //$this->data['ameridoc_message'] = $this->session->flashdata['ameridoc_message'];
                   $this->get_enroll_form($_POST);                 
      
                   
                   $this->data['content'] = 'signup/enroll_form';
                   $this->load->view('index-view', $this->data);
             }

        }

        
             public function payment_portal() {
              $this->form_validation->set_rules('bill_first_name', 'First Name', 'required|xss_clean|trim|strip_tags');
              $this->form_validation->set_rules('bill_last_name', 'Last Name', 'required|xss_clean|trim|strip_tags');
              $this->form_validation->set_rules('bill_phone', 'Phone', 'required|xss_clean|trim|strip_tags');
              $this->form_validation->set_rules('bill_email', 'Email', 'xss_clean|trim|valid_email');
              $this->form_validation->set_rules('bill_address', 'Billing Address', 'required|xss_clean|trim|strip_tags');
              $this->form_validation->set_rules('bill_city', 'City', 'required|xss_clean|trim|strip_tags');
              $this->form_validation->set_rules('bill_state', 'State', 'required|xss_clean|trim|strip_tags|max_length[2]');
              $this->form_validation->set_rules('bill_zip', 'Zip Code', 'required|xss_clean|trim|numeric|min_length[5]');
              $this->form_validation->set_rules('card_num', 'Credit Card Number', 'required|xss_clean|trim|callback_validateCreditcard_number');          
             $this->form_validation->set_rules('exp_year', 'Expiration Year', 'required|xss_clean|trim|integer|callback_validateCreditCardExpirationYear');
             $this->form_validation->set_rules('exp_month', 'Expiration Month', 'required|xss_clean|trim|integer|max_length[2]');
              $this->form_validation->set_rules('cvv', 'Security Code', 'required|xss_clean|trim|integer|max_length[4]');
              
               $this->form_validation->set_message('validateCreditcard_number', 'Please enter a valid credit card number');
               $this->form_validation->set_message('validateCreditCardExpirationYear', 'Please enter a valid expiration year');
               //Join the month and year together into a format authorize will accept
               $expiration = $this->input->post('exp_month').'/'.$this->input->post('exp_year');
            
              if ($this->form_validation->run() == true)
              {
                  // HONEYPOT SPAM FILTER
                 (strlen($_POST['formrequired']) > 0)? exit():'' ;
                 
                  require_once 'anet_php_sdk/AuthorizeNet.php'; // Make sure this path is correct.
                  $transaction = new AuthorizeNetAIM('5Vg6d9mMw', '642X7wLRMtT5r643');   
                  $transaction->setFields(
                        array(
                        'amount' => $this->session->userdata('price'),
                        'card_num' => $this->input->post('card_num'),
                        'exp_date' => $expiration,
                        'first_name' => $this->input->post('bill_first_name'),
                        'last_name' => $this->input->post('bill_last_name'),
                        'address' => $this->input->post('bill_address'),
                        'city' =>$this->input->post('bill_city'),
                        'state' => $this->input->post('bill_state'),
                        'zip' => $this->input->post('bill_zip'),
                        'phone' => $this->input->post('bill_phone'),
                        'email' => $this->input->post('bill_email'),
                        'card_code' => $this->input->post('cvv'),
                        'description' => 'Your Member Id is '.$this->session->userdata['post_data']['ExternalMemberId']
                        )
                    );
                  
                  $transaction->setCustomFields(
                              array(
                                  'member_id' => $this->session->userdata['post_data']['ExternalMemberId']
                              )
                          );
       
                  $response = $transaction->authorizeAndCapture();
                      // If credit card is processed successfully
                      if ($response->approved) {
                          // set session "paid" variable in case ameridoc  enrollment does not go through, after resubmitting enrollment form,
                          //  client will be redirected to the ameridoc processor  instead of payment page
                         $this->session->set_userdata('paid', true);
                         $this->session->set_userdata('transaction_id', $response->transaction_id);
                         $this->session->set_userdata('authorization_id', $response->authorization_id);
                         $this->session->set_userdata('avs_response', $response->avs_response);
                         $this->session->set_userdata('cavv_response', $response->cavv_response);
                         $this->session->set_userdata('bill_email', $this->input->post('bill_email'));
                         // NEED TO ENTER THIS DATA INTO DB OR FILE
                         redirect('signup/ameridoc_processor');
                         /// If credit card was declined
                      }  elseif ($response->declined) {
                          $this->data['enroll_data'] = $this->session->userdata('post_data');
                          $this->session->set_flashdata('message','Your credit card was declined by your bank.  Please try another form of payment.');
                          $this->get_payment_form($_POST);
                          $this->data['content'] = 'signup/payment_form';
                          $this->load->view('index-view', $this->data);
                      } else {
                          $this->data['enroll_data'] = $this->session->userdata('post_data');
                          $this->session->set_flashdata('message','We encountered an error while processing your payment. Your credit card was not charged. Please try again or contact customer service.');
                          $this->get_payment_form($_POST);
                          $this->data['content'] = 'signup/payment_form';
                          $this->load->view('index-view', $this->data);
                      }
                      
              } else {
                  // if payment has already been processed, redirect user to the ameridoc processor
                  ($this->session->userdata('paid'))? redirect('signup/ameridoc_processor') : '';
                  
                  // call method that builds the form 
                  $this->data['enroll_data'] = $this->session->userdata('post_data');
                  $this->get_payment_form($_POST);              
                  $this->data['content'] = 'signup/payment_form';
                  $this->load->view('index-view', $this->data);
              }
        }
        
        public function ameridoc_processor() {
            $ameridoc_response= $this->ameridoc->EnrollNewMember($this->session->userdata('post_data'));
             $success =  $ameridoc_response['Successful'];    
             if ($success === 'true') {
                   /**
                    * AUTHORIZE.NET SENDS A CONFIRMATION EMAIL, USE THE CODE BELOW IF WE FIND
                    * IT DOES NOT OFFER EVERYTHING WE NEED IN A CONFIRMATION EMAIL
                    */
                           /*
                           $message = 'Thank you for enrolling with Ask A Doctor!<br/>';
                           $message .= 'Your confirmation number is '. $this->session->userdata['transaction_id'];

                           // Send confirmation email
                           $this->load->library('email');
                           $this->email->from('billing@askadoctor.com', 'The Doctor');
                            $this->email->to($this->session->userdata['bill_email']);
                            $this->email->cc('rodger.adviceinteractive@gmail.com');


                            $this->email->subject('Ask A Doctor - Confirmation');
                            $this->email->message('Testing the email class.');

                            $this->email->send();

                           */
                
                   $this->session->set_flashdata('message', 'You are now a member');
                   $this->session->set_userdata('ameridoc', $ameridoc_response);
                   redirect('signup/thankyou');
             } else {
                  $this->session->set_flashdata('message', $ameridoc_response['Message']);                    
                   redirect('signup/enroll_info');
             }
        }
        
        public function thankyou() {
              /** ONLY SHOW THE THANKYOU PAGE IF THE PAID VARIABLE HAS BEEN SET
               * OTHERWISE RE-ROUTE TO THE PLANS PAGE
               */
              if (!isset($this->session->userdata['paid'])) {
                  redirect('signup');
              }
              $this->data['message'] = 'You are now a member!';
              $this->data['transaction_id'] = $this->session->userdata['transaction_id'];
              $this->data['member_id'] = $this->session->userdata['post_data']['ExternalMemberId'];
              $this->data['ameridoc_Message'] = $this->session->userdata['ameridoc']['Message'];
              $this->data['ameridoc_AdditionalInfo'] = $this->session->userdata['ameridoc']['AdditionalInfo'];
              $this->data['content'] = 'signup/thankyou';
              $this->load->view('index-view', $this->data);
              $this->session->sess_destroy();
        }
        
        /**************************VALIDATION CALLBACK METHODS*******************************************************************/
        
     function validateCreditcard_number($credit_card_number)
                {
                    // Get the first digit
                    $firstnumber = substr($credit_card_number, 0, 1);
                    // Make sure it is the correct amount of digits. Account for dashes being present.
                    switch ($firstnumber)
                    {
                        case 3:
                            if (!preg_match('/^3\d{3}[ \-]?\d{6}[ \-]?\d{5}$/', $credit_card_number))
                            {
                                return FALSE;
                            }
                            break;
                        case 4:
                            if (!preg_match('/^4\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
                            {
                                return FALSE;
                            }
                            break;
                        case 5:
                            if (!preg_match('/^5\d{3}[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
                            {
                                return FALSE;
                            }
                            break;
                        case 6:
                            if (!preg_match('/^6011[ \-]?\d{4}[ \-]?\d{4}[ \-]?\d{4}$/', $credit_card_number))
                            {
                                return FALSE;
                            }
                            break;
                        default:
                            return FALSE;
                    }
                    // Here's where we use the Luhn Algorithm
                    $credit_card_number = str_replace('-', '', $credit_card_number);
                    $map = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
                                0, 2, 4, 6, 8, 1, 3, 5, 7, 9);
                    $sum = 0;
                    $last = strlen($credit_card_number) - 1;
                    for ($i = 0; $i <= $last; $i++)
                    {
                        $sum += $map[$credit_card_number[$last - $i] + ($i & 1) * 10];
                    }
                    if ($sum % 10 != 0)
                    {
                        return false;
                    }
                    // If we made it this far the credit card number is in a valid format
                    return TRUE;
                }
                
                
                function validateCreditCardExpirationYear( $year)
                    {
                 
                        if (!preg_match('/^\d{4}$/', $year))
                        {
                            return false;
                        }
                        else if ($year < date("Y"))
                        {
                            return false;
                        }
                     
                        return true;
                    }
                    
                   
             
                    
                    
         function validateCVV($cardNumber, $cvv)
                {
                    $firstnumber = (int) substr($cardNumber, 0, 1);
                    if ($firstnumber === 3)
                    {
                        if (!preg_match("/^\d{4}$/", $cvv))
                        {
                            return false;
                        }
                    }
                    else if (!preg_match("/^\d{3}$/", $cvv))
                    {
                        return false;
                    }
                    return true;
                }
                
        function validateDateFormat($date)
        {
           if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $date)) { 
             return true;
            } else {
                return false;
            }
        }
        
        
        function validatePhoneLength($phone) {
            $cleanPhone = preg_replace("/\D/","",$phone); 
            if (strlen($cleanPhone) != 10) {
                return false;
            } else {
                return true;
            }
        }

}

?>
