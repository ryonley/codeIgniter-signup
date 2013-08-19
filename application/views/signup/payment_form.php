
<ul id="breadcrumb">
<li class="first">1. Select Your Plan<span class="arrow"></span></li>
<li>2. Member Information<span class="preactivearrow"></span></li>
<li class="active">3. Process Payment<span class="activearrow"></span></li>
<li class="last">4. Confirmation</li>
</ul>
<!--
<ul id="breadcrumb">

<li class="first">1. Member Information<span class="preactivearrow"></span></li>
<li class="active">2. Process Payment<span class="activearrow"></span></li>
<li class="last">3. Confirmation</li>
</ul>
<div class='mainInfo'>
-->
	


	<div id="infoMessage"><?php echo $message;?></div>

	<p class="bold">Please review the following information.</p>

        <div class="memberInfo" id="member">
                <h2>Member's Information</h2>
                <?$editInfo = array (
                    'title' => 'Edit Info',
                    'id' => 'edit'
                    )?>
                <?=anchor('signup/enroll_info', 'Edit', $editInfo)?>
                <div><span class="label">First Name: </span><span class="value copy"><?= $enroll_data['FirstName']; ?></span></div>
                <div><span class="label">Last Name: </span><span class="value copy"><?= $enroll_data['LastName']; ?></span></div>
                <div><span class="label">Address: </span><span class="value copy"><?= $enroll_data['Address1']; ?></span></div>
                <div><span class="label">City: </span><span class="value copy"><?= $enroll_data['City']; ?></span></div>
                <div><span class="label">State: </span><span class="value" id="memberState"><?= $enroll_data['State']; ?></span></div>
                
                <div><span class="label">Zip Code: </span><span class="value copy"><?= $enroll_data['Zip']; ?></span></div>
                <div><span class="label">Phone: </span><span class="value copy"><?= $enroll_data['Phone']; ?></span></div>
                <div><span class="label">Email: </span><span class="value copy"><?= $enroll_data['Email']; ?></span></div>
        </div>
		
		<div class="memberInfo">
			<h2>Plan Details</h2>
			<div><span class="label">Plan Description:   </span><span class="value copy"><?php echo $plan_description; ?></span></div>
			<div><span class="label">Plan Price:  </span><span class="value copy"><?php echo $price?></span></div>
		</div>

     <?php echo form_open("signup/payment_portal", $formattributes);?>
            
 
                  
               <div class="formfield sameAsLabel">           
              <?php echo form_label('Cardholder\'s information is the same as above.');?> 
                   <?php echo form_checkbox($sameAs);?>    
              </div>
          
               <div class="memberInfo clearfix" id="billing">
                  <h2>Cardholder's Information</h2>
                  
               
                  
                 <div class="formfield dyn">
                <?php echo form_label('First Name', 'bill_first_name');?>
               <?php echo form_input($bill_first_name) ;?>
                </div>

                <div class="formfield dyn">
                <?php echo form_label('Last Name', 'bill_last_name');?>
               <?php echo form_input($bill_last_name) ;?>
                </div>
                <div class="formfield dyn">
               <?php echo form_label('Billing Address', 'bill_address');?>
               <?php echo form_input($bill_address) ;?>
                </div>

                <div class="formfield dyn">
               <?php echo form_label('City', 'bill_city');?>
               <?php echo form_input($bill_city) ;?>
                </div>
                <div class="formfield dyn">
               <?php echo form_label('State', 'bill_state');?>
               <?php echo form_dropdown('bill_state', $state_list, set_value('bill_state') , 'id="State"');?>
               </div>
                <div class="formfield dyn">
               <?php echo form_label('Zip Code', 'bill_zip');?>
               <?php echo form_input($bill_zip) ;?>
               </div>
                <div class="formfield dyn">
               <?php echo form_label('Phone', 'bill_phone');?>
               <?php echo form_input($bill_phone) ;?>
               </div>
                <div class="formfield dyn">
               <?php echo form_label('Email', 'bill_email');?>
               <?php echo form_input($bill_email) ;?>
               </div>
         <?= form_input($special);?>
		 
		        <div id="cardInfo" class="clearfix">
						<div class="formfield">
					  <img src="<?php print base_url(); ?>assets/images/cclogos.gif" alt="accepted credit cards" width="230" height="35"/>
					  </div>
					  <div class="formfield">
					  <?php echo form_label('Card Number', 'card_num');?>
					  <?php echo form_input($card_num);?>
					 </div>
						
					  <div class="formfield">         
						  <?php echo form_label('Expiration Date');?>
					   <?php echo form_dropdown('exp_month', $month_list, 'id="exp_month"');?>        
					   <?php echo form_dropdown('exp_year', $year_list, 'id="exp_year"');?>       
					  </div>
						
					  <div class="formfield">
					  <?php echo form_label('Security Code:', 'cvv');?>
					  <?php echo form_input($cvv);?>
					   </div>
					   
					
			 </div>
     </div>   
	 
	 
        

	   
                   <!--<div class="formfield" id="captcha">-->
				   <!-- to echo field echo recaptcha()-->

					<!--</div>-->
	    

       <p><?php echo form_submit('submit', 'Process Payment', 'id="pay"');?></p>
      
      <?php echo form_close();?>

