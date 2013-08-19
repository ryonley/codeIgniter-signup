<?php

class Transactions_model extends CI_Model{
    
    	/** Utility Methods **/
	function _required($required, $data)
	{
		foreach($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
	
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
        
 
        
    
    function AddTransaction($options = array()) {
	// required values
        /*
		if(!$this->_required(
			array('transaction_id', 'Amount', 'CardholderFirstName', 'CardholderLastName'),
			$options)
		) return false;*/
		
		
		
		$this->db->insert('transactions', $options);
		
		return $this->db->insert_id();        
    }
    
    function UpdateTransaction($TransactionTableId, $options = array()) {
        // required values
        /*
		if(!$this->_required(
			array('AmeridocMessage', 'AdditionalInfo','ExternalMemberId', 
                                                                  'FirstName', 'LastName', 'DOB', 'Gender', 'Address1', 'Address2', 'City', 'State', 'Zip', 'Phone', 'Email',
                                                                   'PlanOption'),
			$options)
		) return false;*/
                
 
                                   $this->db->where('id', $TransactionTableId);
                                   $this->db->update('transactions', $options );
                                   return $this->db->affected_rows();
    }
    

}
