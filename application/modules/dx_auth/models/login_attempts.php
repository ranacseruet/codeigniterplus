<?php
class Login_Attempts extends CI_Model 
{
	function __construct()       
	{
		parent::__construct();

		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_login_attempts_table');
	}

	function check_attempts($ip_address)
	{
		$this->db->select('1', FALSE);
		$this->db->where('ip_address', $ip_address);
		return $this->db->get($this->_table);
	}
	
	// Increase attempts count
	function increase_attempt($ip_address)
	{
		// Insert new record
		$data = array(
			'ip_address' => $ip_address
		);

		$this->db->insert($this->_table, $data); 
	}
	
	function clear_attempts($ip_address)
	{		
		$this->db->where('ip_address', $ip_address);
		$this->db->delete($this->_table);
	}	
	
}
?>