
<ul id="breadcrumb">
<li class="first">1. Select Your Plan <span class="preactivearrow"></span></li>
<li class="active">2. Member Information<span class="activearrow"></span></li>
<li>3. Process Payment <span class="arrow"></span></li>
<li class="last">4. Confirmation </li>
</ul>

<!--
<ul id="breadcrumb">

<li class="active first">1. Member Information<span class="activearrow"></span></li>
<li>2. Process Payment <span class="arrow"></span></li>
<li class="last">3. Confirmation </li>
</ul>
-->





<div class='mainInfo  clearfix'>

	<h1>Enroll Now!</h1>
	<p class="subtitle">Please enter the member's  information below.</p>
        
    
        

	<div id="infoMessage"><?php echo $message;?></div>
   

    <?php echo form_open("signup/enroll_info", $formattributes);?>
    
        <div class="topBlock memberInfo clearfix">
		
		  <h2>Member's Information</h2>
               <?= form_input($special);?>
            
               <div class="formfield">
               <?php echo form_error('FirstName'); ?>
               <?php echo form_label('First Name', 'FirstName');?>
              <?php echo form_input($FirstName);?>
               </div>
           
              <div class="formfield">
                  <?php echo form_error('LastName'); ?>
              <?php echo form_label('Last Name', 'LastName');?>
              <?php echo form_input($LastName);?>
              </p>
               </div>

                  <div class="formfield">
                      <?php echo form_error('Email'); ?>
              <?php echo form_label('Email:', 'Email');?>
              <?php echo form_input($Email);?>
                </div>
           
                 <div class="formfield">
          <?php echo form_error('Phone'); ?>
              <?php echo form_label('Phone:', 'Phone');?>
              <?php echo form_input($Phone);?>
             </div>

                      <div class="formfield">
                          <?php echo form_error('Address1'); ?>
              <?php echo form_label('Address 1:', 'Address1');?>
              <?php echo form_input($Address1);?>
              </div>
           
                      <div class="formfield">
                <?php echo form_error('Address2'); ?>
              <?php echo form_label('Address 2:', 'Address2');?>
              <?php echo form_input($Address2);?>
            </div>

               <div class="formfield">
                   <?php echo form_error('City'); ?>
              <?php echo form_label('City:', 'City');?>
              <?php echo form_input($City);?>
             </div>
            
           <?php $State= (isset($post_data['State']))? $post_data['State'] : set_value('State'); ?>
            <div class="formfield">
                   <?php echo form_error('State'); ?>
              <?php echo form_label('State:', 'State');?>
              <?php  echo form_dropdown('State', $state_list, $State, 'id = "state", class = "required"');?>
             </div>
           
              <div class="formfield">
                  <?php echo form_error('Zip'); ?>
              <?php echo form_label('Zip:', 'Zip');?>
              <?php echo form_input($Zip);?>
             </div>
           
              <?php $Gender= (isset($post_data['Gender']))? $post_data['Gender'] : set_value('Gender'); ?>
               <div class="formfield">
              <?php echo form_error('Gender'); ?>
              <?php echo form_label('Gender:', 'Gender');?>
              <?php echo form_dropdown('Gender', $gender_list, $Gender ,'id="Gender", class="required"');?>
              </div>

            
         

              <?php $month = (isset($post_data['month']))? $post_data['month']: set_value('month'); ?>          
              <?php $day = (isset($post_data['day']))? $post_data['day']: set_value('day'); ?>
              <?php $year = (isset($post_data['year']))? $post_data['year']: set_value('year'); ?>
              <div class="formfield">
              <?php echo form_label('Date of Birth:');?>
              <?php echo form_dropdown('month', $month_list, $month, 'class="required"'); ?>
              <?php echo form_dropdown('day', $day_list, $day, 'class="required"'); ?>
              <?php echo form_dropdown('year', $year_list, $year, 'class="required"'); ?>
              </div>
             
        
        </div>
 
  
   <div class="lowerblock">   




      

      <p><?php echo form_submit('submit', 'Enroll', 'id="enroll"');?></p>
</div>  

    <?php echo form_close();?>

</div>
