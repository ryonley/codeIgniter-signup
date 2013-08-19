<?php

class Transaction_model extends CI_Model{
    
    	/** Utility Methods **/
	function _required($required, $data)
	{
		foreach($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
    
     function AddTransaction($TransactionId) {
         $CardholderFirstName = $this->input->post('bill_first_name');
         $CardholderLastName = $this->input->post('bill_last_name');
         $post_data = $this->session->userdata('post_data');
         $ExternalMemberId = $post_data['ExternalMemberId'];
         $Amount = $this->session->userdata('price');
       
         
         $data = array (
               'TransactionId' => $TransactionId,
             'Amount' => $Amount,
             'CardholderFirstName' => $CardholderFirstName,
             'CardholderLastName' => $CardholderLastName
         );
         
         $this->db->insert('transactions', $data);
         return $this->db->insert_id();    
     }
     
     /*
         function UpdateTransaction($TransactionTableId, $options = array()) {
        // required values
		if(!$this->_required(
			array('AmeridocMessage', 'AdditionalInfo','ExternalMemberId', 
                                                                  'FirstName', 'LastName', 'DOB', 'Gender', 'Address1', 'Address2', 'City', 'State', 'Zip', 'Phone', 'Email',
                                                                   'PlanOption'),
			$options)
		) return false;
                
 
                                   $this->db->where('id', $TransactionTableId);
                                   $this->db->update('transactions', $options );
                                   return $this->db->affected_rows();
      }*/
      
      function UpdateTransaction($TransactionTableId) {
   
      }
}
