<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Entities/DxUserProfile.php");

use \DxUserProfile;

class User_Profile extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxUserProfile", $this->doctrine->em);
	}

	function delete_profile($user_id)
	{
		$entity = $this->em->getPartialReference($this->entity, $user_id);
		$this->em->remove($entity);
		$this->em->flush();

		return TRUE;
	}
}

/* .........From here no function called......May be in future it would used..................... */
/*
  function create_profile($user_id)
  {
  $this->db->set('user_id', $user_id);
  //$this->db->set('city_id', "1");//Rana: Default For test purpose
  return $this->db->insert($this->_table);
  }

  function get_profile_field($user_id, $fields)
  {
  $this->db->select($fields);
  $this->db->where('user_id', $user_id);
  return $this->db->get($this->_table);
  }

  function get_profile($user_id)
  {
  $this->db->where('user_id', $user_id);
  return $this->db->get($this->_table);
  }

  function set_profile($user_id, $data)
  {
  $this->db->where('user_id', $user_id);
  return $this->db->update($this->_table, $data);
  }
 */