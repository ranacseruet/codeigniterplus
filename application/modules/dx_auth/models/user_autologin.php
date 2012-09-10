<?php

class User_Autologin extends CI_Model 
{
	function __construct()
	{
		parent::__construct();

		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_user_autologin');
		$this->_users_table = $this->_prefix.$this->config->item('DX_users_table');		
	}

	function store_key($key, $user_id)
	{
		$user = array(
			'key_id' 			=> md5($key),
			'user_id' 		=> $user_id,
			'user_agent' 	=> substr($this->input->user_agent(), 0, 149),
			'last_ip' 		=> $this->input->ip_address()
		);

		return $this->db->insert($this->_table, $user);
	}

	function get_key($key, $user_id)
	{
		$auto_table = $this->_table;
		$users_table = $this->_users_table;
		
		$this->db->select("$users_table.id");
		$this->db->select("$users_table.username");
		$this->db->select("$users_table.role_id");
		$this->db->from($users_table);		
		$this->db->join($auto_table, "$auto_table.user_id = $users_table.id");
		$this->db->where("$users_table.id", $user_id);
		$this->db->where("$auto_table.key_id", md5($key));
		
		return $this->db->get();
	}

	function delete_key($key, $user_id)
	{
		$data = array(
			'key_id' 	=> md5($key),
			'user_id' => $user_id
		);
		
		$this->db->where($data);
		return $this->db->delete($this->_table);
	}

	function clear_keys($user_id)
	{
		$this->db->where('user_id', $user_id);
		return $this->db->delete($this->_table);
	}

	function prune_keys($user_id)
	{
		$data = array(
			'user_id'			=> $user_id,
			'user_agent' 	=> substr($this->input->user_agent(), 0, 149),
			'last_ip' 		=> $this->input->ip_address()
		);

		$this->db->where($data);
		return $this->db->delete($this->_table);
	}
}

?>