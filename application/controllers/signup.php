<?php

if (!defined('BASEPATH'))
        exit('No direct script access allowed');

class Signup extends CI_Controller {
    
           function __construct()
          {
                parent::__construct();
                $this->load->library('ameridoc');
                $this->load->helper('recaptcha');
                $this->load->model('transactions_model');
				
               $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
               $this->output->set_header("Pragma: no-cache");
          }
    
            public function index() {
			
				if (isset($_POST['plan'])) {
					  $selected_plan = $_POST['plan'];
						switch ($selected_plan) {
									case "Basic-Individual-Monthly":
									$price = "8.95";
									$plan = '1';
									$planID = '57';
								
									break;
									//case "Basic-Individual-Annual":
									//$price = "107.40";
									////$plan = '1';
									//break;
									case "Basic-Family-Monthly":
									$price = "15.95";
										$plan = '2';
									$planID = '57';
									break;
									//case "Basic-Family-Annual":
									//$price = "191.40";
									//	$plan = '2';
									//break;
									case "Enhanced-Individual-Monthly":
									$price = "12.95";
										$plan = '1';
										$planID = '58';
									break;
									//case "Enhanced-Individual-Annual":
									///$price = "155.40";
									//	$plan = '1';
									//break;
									case "Enhanced-Family-Monthly":
									$price = "19.95";
										$plan = '2';
										$planID = '58';
									break;
									//case "Enhanced-Family-Annual":
									//$price = "239.40";
									//	$plan = '2';
									//break;
									case "Unlimited-Individual-Monthly":
									$price = "19.95";
										$plan = '1';
										$planID = '59';
									break;
									//case "Ultimate-Individual-Annual":
									//$price = "203.40";
									//	$plan = '1';
									//break;
									case "Unlimited-Family-Monthly":
									$price = "29.95";
										$plan = '2';
										$planID = '59';
									break;
									//case "Ultimate-Family-Annual":
									//$price = "299.40";
									//	$plan = '2';
									//break;
						}
						// Add the price to the session
						$this->session->set_userdata('price', $price);
						$this->session->set_userdata('plan', $plan);
						$this->session->set_userdata('planid', $planID);
						$this->session->set_userdata('plan_description', $_POST['plan']);
					  //Display enrollment form
			
					  redirect("signup/enroll_info");
				  } else {
				 redirect("http://www.ask-the-dr.com/medical-plans.html");
		
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

                   $this->data['month_list'] = array(
                    ''=>'Month',
                     '1'=>'Jan', 
                     '2'=>'Feb', 
                     '3'=> 'Mar', 
                     '4'=> 'Apr', 
                     '5'=> 'May', 
                      '6'=> 'Jun', 
                      '7'=> 'Jul', 
                      '8'=> 'Aug', 
                      '9'=> 'Sep', 
                      '10'=> 'Oct', 
                      '11'=> 'Nov', 
                      '12'=> 'Dec');

                   /*
                     $this->data['month_list']  = array();
                  for ($i = 1; $i <= 12; $i++)
                  {
                      $this->data['month_list'][$i] = $i;
                  }
                  // add a "select" to the beginning of the array
                  $this->array_unshift_assoc($this->data['month_list'], "", "Month");
                  */


                  $this->data['day_list'] = array();
                  for($i = 1; $i <= 31; $i++)
                  {
                    $this->data['day_list'][$i] = $i;
                  }
                  $this->array_unshift_assoc($this->data['day_list'], "", "Day");



                  $this->data['year_list'] = array();
                  $thisyear = date("Y");
                  for($i = $thisyear; $i >= 1900 ; $i--) {
                    $this->data['year_list'][$i] = $i;
                  }
                  $this->array_unshift_assoc($this->data['year_list'], "", "Year");
                  

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

           
        }
        
        private function get_payment_form($post) {
		       if(!isset($this->data['message'])) {
			           
						 if (validation_errors()) {
						$this->data['message'] = validation_errors();
						} else {
							$this->data['message'] = $this->session->flashdata('message');
						
						}
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
                    'id' => 'card'
               
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
        
        
         private function array_unshift_assoc(&$arr, $key, $val)
                {
                    $arr = array_reverse($arr, true);
                    $arr[$key] = $val;
                    $arr = array_reverse($arr, true);
                    return count($arr);
                }
        
        public function enroll_info() {
                 $this->data['title'] = "Enroll";
                 $this->form_validation->set_rules('FirstName', 'First Name', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('LastName', 'Last Name', 'required|xss_clean|trim|strip_tags');
                 //$this->form_validation->set_rules('DOB', 'Date of Birth', 'required|xss_clean|trim|strip_tags|callback_validateDateFormat');

                 $this->form_validation->set_rules('month', 'Month', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('day', 'Day', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('year', 'Year', 'required|xss_clean|trim|strip_tags');


                 $this->form_validation->set_rules('Gender', 'Gender', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('Address1', 'Address', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('City', 'City', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('State', 'State', 'required|xss_clean|trim|strip_tags');
                 $this->form_validation->set_rules('Zip', 'Zipcode', 'required|xss_clean|trim|strip_tags|exact_length[5]|integer');
                 $this->form_validation->set_rules('Phone', 'Phone', 'required|trim|strip_tags|xss_clean|callback_validatePhoneLength');
                 $this->form_validation->set_rules('Email', 'Email', 'trim|strip_tags|valid_email|xss_clean');
                 $this->form_validation->set_message('validateDateFormat', 'Please use the mm/dd/yyy date format.');
                 $this->form_validation->set_message('validatePhoneLength', 'Please enter your 10 digit telephone number.');
                 $this->form_validation->set_error_delimiters('<div class="serverror">', '</div>');
                 
                      // IF THE VALIDATION PASSES
             if ($this->form_validation->run() == true)
             {
                 // HONEYPOT SPAM FILTER
                 (strlen($_POST['formrequired']) > 0)? exit():'' ;
                 
                  //  WILL NEED TO GENERATE EXTERNAL MEMBER ID  IF ONE WASN'T ALREADY CREATED ON THE LAST SUBMISSION  //     
                 // HOWEVER IF THE EXTERNAL MEMBER ID EXISTS IN THE SESSION, SET THAT VALUE TO $ExternalMemberId
                  $post_data = ($this->session->userdata('post_data'))?  $this->session->userdata('post_data') : '';
                  if (isset($post_data['ExternalMemberId'])) {
                      $ExternalMemberId = $post_data['ExternalMemberId'];
                  } else {
                       $ExternalMemberId = (!isset($ExternalMemberId)) ? $this->ameridoc->GetRandomMemberId() : $ExternalMemberId;
                  }
                 
                
                //  Get TODAY'S DATE FOR THE EFFECTIVE DATE REQUIREMENT
                $EffectiveDate = date('m/d/Y');
				if ( $EffectiveDate == (date('m')."/01/".date('Y')) ) $EffectiveDate = (date('m')."/02/".date('Y'));
				
				//$EffectiveDate = '09/09/2011';
				// Save it in the session for debugging purposes
                $this->session->set_userdata('effectivedate', $EffectiveDate);
				
                
                /// NEED TO SET THE PLAN OPTION AND THE RELATIONSHIP AND PRIMEMEMBERIDD AUTOMATICALLY

                $dob = $_POST['month'].'/'.$_POST['day'].'/'.$_POST['year'];
                
                 $post_data = array(
                            'Key' =>$this->ameridoc->GetKey(),
                            'ExternalMemberId' => $ExternalMemberId,
                            'FirstName' => $_POST['FirstName'],
                            'LastName' => $_POST['LastName'],
                            //'DOB' =>$_POST['DOB'],
                            'DOB' =>$dob,
                            'Gender' => $_POST['Gender'],
                            'Address1' => $_POST['Address1'],
                            'Address2' => $_POST['Address2'],
                            'City' => $_POST['City'],
                            'State' => $_POST['State'],
                            'Zip' => $_POST['Zip'],
                            'Phone' => $_POST['Phone'],
                            'Email' => $_POST['Email'],
                            'GroupNumber' => $this->ameridoc->GetGroupNumber(),
                            'PlanId' => $this->session->userdata('planid'),
                            'PlanOption' => $this->session->userdata('plan'),
                            'EffectiveDate' => $EffectiveDate,
                            'Relationship' => '0',
                            'PrimaryExternalMemberId' => $ExternalMemberId     
                     );
                 
                 // Save the post data to a session
                 $this->session->set_userdata('post_data', $post_data);
                 redirect('signup/payment_portal');
                 
             } else {
                   $this->get_enroll_form($_POST);                 
					// send effective date to view for debugging
				   //$this->data['effectivedate'] = date('m/d/Y');
                   
                   $this->data['content'] = 'signup/enroll_form';
                   $this->load->view('index-view', $this->data);
				  
             }

        }

        
             public function payment_portal() {
               // set to live when done testing 
               $mode = 'live';  
             
                   
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
            //$this->form_validation->set_rules('recaptcha_response_field', 'Captcha response', 'required|recaptcha_matches');			  
               $this->form_validation->set_message('validateCreditcard_number', 'Please enter a valid credit card number');
               $this->form_validation->set_message('validateCreditCardExpirationYear', 'Please enter a valid expiration year');
               //Join the month and year together into a format authorize will accept
               $expiration = $this->input->post('exp_month').'/'.$this->input->post('exp_year');
			   
			   $plan_description = $this->session->userdata('plan_description');
			   $plan_description = str_replace('-', ' ', $plan_description);
			    $this->data['plan_description'] = $plan_description;	
				$this->data['price'] = $this->session->userdata('price');
            
              if ($this->form_validation->run() == true)
              {
                  // HONEYPOT SPAM FILTER
							 (strlen($_POST['formrequired']) > 0)? exit():'' ;
							 
							  require_once 'anet_php_sdk/AuthorizeNet.php'; // Make sure this path is correct.
                if($mode == 'live') {
  							  $transaction = new AuthorizeNetAIM('9MJ9ru9vx32', '6722HDz99Bg24qqG');   
  							  $transaction->setSandbox(false);
                } else {
                  $transaction = new AuthorizeNetAIM('5Vg6d9mMw', '642X7wLRMtT5r643');   
                  $transaction->setSandbox(true);
                }
                $transaction->setLogFile('/home/askthedr/public_html/authLog.txt');
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
									'description' => 'Plan Purchased: '.$this->session->userdata('plan_description')
								    //'test_request' => 'true'
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
									 $transaction_id = $response->transaction_id;
									 $this->session->set_userdata('transaction_id', $transaction_id);
									 //$this->session->set_userdata('authorization_id', $response->authorization_id);
									 $this->session->set_userdata('avs_response', $response->avs_response);
									 $this->session->set_userdata('cavv_response', $response->cavv_response);
									 $this->session->set_userdata('bill_email', $this->input->post('bill_email'));
									 
									 //$this->session->set_flashdata('message', $transaction_id);
									  // BUILD AN ARRAY THAT WILL BE PASSED TO THE TRANSATIONS MODEL
									 
									 $transactionData = array(
										 'transaction_id' => $this->session->userdata('transaction_id'),
										 'Amount' => $this->session->userdata('price')                     
										 
									 );
									 // CALCULATE THE NEXT BILL DATE, NEXT BILLE DATE IS ALWAYS ONE MONTH FROM TODAY
									
									 $nextBillDate = $this->getNextBillDateV2();
									 $this->session->set_userdata('nextBillDate', $nextBillDate);
									 // NEED TO ENTER THIS DATA INTO DB                      
								 
									 $transactionTableId = $this->transactions_model->addTransaction($transactionData);
									 $this->session->set_userdata('transactionTableId', $transactionTableId);
									 if($transactionTableId) {
										 //transaction info was successfully inserted into the database                         
									 } else {
										 //the transaction info was not saved successfully
									 }
									
									redirect('signup/ameridoc_processor');
									 /// If credit card was declined
								  }  elseif ($response->declined) {		
																  
									  $this->data['enroll_data'] = $this->session->userdata('post_data');                 
									  $this->data['message'] = 'Your credit card was declined by your bank.  Please try another form of payment.';
									  $this->get_payment_form($_POST);
									  $this->data['content'] = 'signup/payment_form';
									  $this->load->view('index-view', $this->data);
								 } elseif ($response->held) {	
															 
									   $this->data['enroll_data'] = $this->session->userdata('post_data');                 
									  $this->data['message'] = 'The transaction is being held for review.  You will be contacted ASAP about your order.  We apologize for any inconvenience.';
									  $this->get_payment_form($_POST);
									  $this->data['content'] = 'signup/payment_form';
									  $this->load->view('index-view', $this->data);
								  } else {	
									  $reason = (isset($response->response_reason_text))? $response->response_reason_text: '';
									
									  $this->data['enroll_data'] = $this->session->userdata('post_data');
									  $this->data['message'] = 'We encountered an error while processing your payment. '.$reason.' Please try again or contact customer service.';
									  $this->get_payment_form($_POST);
									  $this->data['content'] = 'signup/payment_form';
									  $this->load->view('index-view', $this->data);
								  }
                      
              } else {
			        // send for debugging		
					//$this->data['effectivedate'] = $this->session->userdata('effectivedate');	
						
			       $this->data['authorizeResponse'] = 'authorization no initiated';
				   
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
                           
                           $message = 'Thank you for enrolling with Ask A Doctor!<br/>';
                           $message .= 'Your confirmation number is '. $this->session->userdata['transaction_id'];

                     

                           
                
                   //$this->session->set_flashdata('message', 'You are now a member');
                   $this->session->set_userdata('ameridoc_response', $ameridoc_response);
                   
                      // BUILD AN ARRAY THAT WILL BE PASSED TO THE TRANSATIONS MODEL
                   
                         $memberData = array(         
               
        
                             'AmeridocMessage' => $ameridoc_response['Message'],
                             'AdditionalInfo' => $ameridoc_response['AdditionalInfo'],
                             'ExternalMemberId' =>  $this->session->userdata['post_data']['ExternalMemberId'],
                             'FirstName' => $this->session->userdata['post_data']['FirstName'],
                             'LastName' => $this->session->userdata['post_data']['LastName'],
                             'DOB' => $this->session->userdata['post_data']['DOB'],
                             'Gender' => $this->session->userdata['post_data']['Gender'],
                             'Address1' => $this->session->userdata['post_data']['Address1'],
                             'Address2' => $this->session->userdata['post_data']['Address2'],
                             'City' => $this->session->userdata['post_data']['City'],
                             'State' => $this->session->userdata['post_data']['State'],
                             'Zip' => $this->session->userdata['post_data']['Zip'],
                             'Phone' => $this->session->userdata['post_data']['Phone'],
                             'Email' =>$this->session->userdata['post_data']['Email'],
                             'PlanOption' => $this->session->userdata['post_data']['PlanOption']
                         );
                         // NEED TO ENTER THIS DATA INTO DB OR FILE
                         
                         // RETURNS THE SAME TRANSATION ID THAT IS SENT TO THE DB, THIS IS USED AS THE PRIMARY FIELD
                         $affectedRows = $this->transactions_model->updateTransaction($this->session->userdata['transactionTableId'], $memberData);
                         $this->session->set_userdata('affectedRows', $affectedRows);
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
                   redirect("http://www.ask-the-dr.com/medical-plans.html");
              }
			  
			   $ameridoc_response= $this->session->userdata('ameridoc_response');
			   $additional_info_array = preg_split("/[\s,]+/", $ameridoc_response['AdditionalInfo']);
			   list($username, $password) = $additional_info_array;
			   
					///// SEND CONFIRMATION EMAIL
					      
						   $text = 'Text version of the email';
					       $message = $this->buildMessage($username, $password);
						   $to = $this->session->userdata['bill_email'];
						   
						   /*** New Method of sending the email ***/
						   /*
						   include('/home/askthedr/public_html/pearMail.php');
						   */
						   
						   /*** Old Method of sending email ***/
						   
                           $this->load->library('email');
						   
						    $config['charset'] = 'ISO-8859-1';
							$config['wordwrap'] = TRUE;
							$config['mailtype'] = 'html';
							/*
							$config['smtp_port'] = '465';
							$config['smtp_pass'] = 'tacoma2279';
							$config['smtp_user'] = 'rodger.adviceinteractive@gmail.com';
							$config['smtp_host'] = 'ssl://smtp.gmail.com';*/
							$this->email->initialize($config);
						   
                            $this->email->from('admin@ask-the-dr.com', 'Ask The Doctor');
                            $this->email->to($this->session->userdata['bill_email']);
                            //$this->email->cc('dasch@extremecommunications.com');
							$this->email->bcc('support@ask-the-dr.com');


                            $this->email->subject('Ask The Doctor - Confirmation');
                            $this->email->message($message);

                            $this->email->send();
							
					//////////////////////////////////////////////////
			   
			   
			   $this->data['username'] = $username;
			  $this->data['password'] = $password;			  
              $this->data['transaction_id'] = $this->session->userdata['transaction_id'];
               $this->data['message'] = '<h1>You are now a member!</h1>  
			  <h2>You will receive a confirmation email shortly.</h2>
			  ';
			  
			 
              
              $this->data['content'] = 'signup/thankyou';
              $this->load->view('index-view', $this->data);
             $this->session->sess_destroy();
        }
		
		public function sendMail() {
		    include('/home/askthedr/public_html/pearMail.php');
			
		   
		}
		 
		private function buildTextMessage($username, $password) {
		 
		
		}
		
		private function buildMessage($username, $password) {
		         $plan_desc = $this->session->userdata('plan_description');
		
		         $message = ' 
				     <img style=”display:block; width: 343px; height: 96px;” src="http://www.ask-the-dr.com/signup/assets/images/logo.png" alt="Ask the Doctor"/>
					 <p>Thank you for enrolling with Ask The Doctor.
					 <span>You have signed up for the </span><span style="color: #2594CB;">'.$plan_desc.' plan</span>.  Please print and save this information for your records.</p>
					 <table border="1" style="width: 350px;">			 
						 <tr style="background-color: #C3E6FA;"><td align="center" style="background-color: #C3E6FA;" width="100%" colspan="2"><strong>Your Information</strong></td></tr>
						 <tr><td>Your Confirmation Number is: </td><td style="font-weight: bold;">'.$this->session->userdata['transaction_id'].'</td></tr>
						 <tr><td>Ameridoc Username:</td><td  style="font-weight: bold;">'.$username.'</td></tr>
						 <tr><td>Ameridoc Password:</td><td  style="font-weight: bold;">'.$password.'</td></tr>
						 <tr><td>Start Date:</td><td  style="font-weight: bold;">'.$this->session->userdata['effectivedate'].'</td></tr>
						 <tr><td>Next Billing Date:</td><td  style="font-weight: bold;">'.$this->session->userdata['nextBillDate'].'</td></tr>
					 </table>
					 <p></p>
					 
				 ';
				 //  Determine which plan specific message to use.
				 $plan = explode('-', $plan_desc);
				 switch ($plan[0]) {
					case 'Basic':
					    switch ($plan[1]) {
							case 'Individual':
							    $message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Basic Individual Plan</span> includes unlimited free email and telephone informational consultations, and $35 diagnostic medical consultations.</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions.</p>';
				 				 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. After you have paid the $35 fee, a licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
							case 'Family':
								$message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Basic Family Plan</span> includes unlimited free email and telephone informational consultations, and $35 diagnostic medical consultations for you and your immediate family.</p>';
								$message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you or any family members have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions..</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you or any family members need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. After you have paid the $35 fee, a licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
						}
					break;
					case 'Enhanced':
						switch ($plan[1]) {
							case 'Individual':
								$message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Enhanced Individual Plan</span> includes unlimited free email and telephone informational consultations, and two free diagnostic medical consultations each year.  Additional diagnostic consultations are $35 each. </p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions.</p>';
				 				 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. A licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
							case 'Family':
								$message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Enhanced Family Plan</span> includes unlimited free email and telephone informational consultations, and two free diagnostic medical consultations each year for you and your immediate family.  Additional diagnostic consultations are $35 each.  </p>';
								$message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you or any family members have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions.</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you or any family members need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. A licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
						
						}
					break;
					case 'Unlimited':
						switch ($plan[1]) {
							case 'Individual':
								$message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Unlimited Individual Plan</span> includes unlimited email and telephone informational consultations, AND unlimited diagnostic medical consultations.</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions.</p>';
				 				 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. A licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
							case 'Family':
								$message .= '<p>Your <span style="font-weight: bold; color: #2594CB;">Unlimited Family Plan</span> includes unlimited email and telephone informational consultations, AND unlimited diagnostic medical consultations for you and your immediate family.</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Informational Medical Consultations</span> are for medical information and general advice about common symptoms and medical conditions. If you or any family members have a general medical question, you can call Member Services anytime 24 hours a day at 1-877-263-7409.  You will then be immediately connected with a licensed, U.S.-based physician to answer your questions.</p>';
								 $message .= '<p><span style="font-weight: bold; color: #2594CB;">Diagnostic Medical Consultations</span> are for diagnosis and specific treatment recommendations. Medication may be prescribed as appropriate. If you or any family members need a Diagnostic Medical Consultation, please login, update your Electronic Health Record (EHR) and call Member Services at 1-877-263-7409 for your consultation. A licensed, U.S.-based physician in your state (as required by law) will review your EHR and call you within an hour for your consultation.</p>';
		
								break;
						
						}
					break;
				 }
				 
				
		 
				 $message .= '<p>You can access your <span style="font-weight: bold; color: #2594CB;">EHR</span> by logging in at www.ask-the-dr.com or at www.ameridoc.com.  Enter your Ameridoc Username and Password and you will be immediately connected to your personal Electronic Health Record. </p>';
				 
				 $message .= '<p>If you have any questions or need help updating your EHR please contact Member Services at 1-877-263-7409.</p>';
				 
				 return $message;
		}
		
		function getNextBillDateV2() {
			$datestring = "now";
			
			$today = new DateTime($datestring, new DateTimeZone('CST'));
			$today = $today->format('d');
			
			$d = new DateTime($datestring, new DateTimeZone('CST'));
			$d->modify('last day of next month');
			$last_day_next_month = $d->format('d');
			
			if($today > $last_day_next_month) {
				$nextBill =  $d->format('m/d/Y'); 
			} else {
				$n = new DateTime($datestring, new DateTimeZone('CST'));
				$n->modify('next month');
				$nextBill = $n->format('m/d/Y');
			}			
			return $nextBill;
		}
		
		
		function getNextBillDate() {
			$datoday = date('m-d-Y');
			$dueday   = 31;

			$datepart = explode("-",$datoday);

			$yean = intval($datepart[2]);
			$mont = intval($datepart[0]);
			$day  = intval($datepart[1]);
			$tmon = $mont;
			$tyea = $yean;

			$tmon +=1; 
			if ($tmon > 12) { $tmon = 1; $tyea += 1; }

			$num_days_next_month =  (cal_days_in_month(CAL_GREGORIAN, intval($tmon), intval($tyea)));
			$num_days_this_month =  (cal_days_in_month(CAL_GREGORIAN, intval($mont), intval($yean)));

			$nextday = $day + $dueday;

			if ( $nextday > $num_days_this_month ) $nextday = ($nextday - $num_days_next_month);



			if ( ($nextday) > $num_days_next_month ) $nextday = $num_days_next_month;

            if(strlen($tmon) == 1) $tmon = "0".$tmon;
			if(strlen($nextday) == 1) $nextday = "0".$nextday;
			$duedate = "$tmon/$nextday/$yean";
			
			return $duedate;
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
