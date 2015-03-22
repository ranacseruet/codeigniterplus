<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \DxUsers;
use \DxUserProfile;
use \DxRoles;

/**
 * manipulates data and contains data access logics for Enity 'User'
 *
 * @final    Usermodel
 * @category models 
 * @author   Md. Ali Ahsan Rana
 * @link     http://codesamplez.com
 */
class Usermodel extends My_DModel {

	//var $table = "dx_users";
	var $entity_profile = "DxUserProfile";
	var $table2 = "dx_user_profile";

	function __construct()
	{
		parent::__construct();
		$this->init("DxUsers", $this->doctrine->em);
	}

	function hasProfile($id)
	{
		try {
			$user = $this->em->getReference($this->entity, $id);
			$criteria = array("user" => $user);
			$user = $this->em->getRepository($this->entity_profile)->findOneBy($criteria);
			return !empty($user);
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return FALSE;
		}
	}

	/**
	 * @param int $id
	 * @return DxUserProfile
	 */
	function get_profile($id)
	{
		try {
			$user = $this->em->getReference($this->entity, $id);
			$criteria = array("user" => $user);
			return $this->em->getRepository($this->entity_profile)->findOneBy($criteria);
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return NULL;
		}
	}
}