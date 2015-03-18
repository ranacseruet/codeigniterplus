<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Entities/DxUserTemp.php");

use \DxUserTemp;

class User_Temp extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxUserTemp", $this->doctrine->em);
		/* ................other staff need for active record...................... */
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix . $this->config->item('DX_user_temp_table');
	}

	function get_user_by_username($username)
	{
		$criteria = array('username' => $username);
		$query = $this->em->getRepository($this->entity)->findOneBy($criteria);
		return $query;
	}

	function get_user_by_email($email)
	{
		$criteria = array('email' => $email);
		$query = $this->em->getRepository($this->entity)->findOneBy($criteria);
		return $query;
	}

	function get_login($login)
	{
		$criteria = array('username' => $login);
		$query = $this->em->getRepository($this->entity)->findOneBy($criteria);
		return $query;
	}

	function check_username($username)
	{
		$criteria = array('username' => $username);
		$query = $this->em->getRepository($this->entity)->findBy($criteria);
		return $query;
	}

	function check_email($email)
	{
		$criteria = array('email' => $email);
		$user = $this->em->getRepository($this->entity)->findBy($criteria);
		return $user;
	}

	function activate_user($username, $key)
	{
		$criteria = array('username' => $username, 'activationKey' => $key);
		$user = $this->em->getRepository($this->entity)->findBy($criteria);
		return $user;
	}

	function delete_user($id)
	{
		$entity = $this->em->getPartialReference($this->entity, $id);

		if ($entity) {
			$this->em->remove($entity);
			$this->em->flush();
		}

		return TRUE;
	}

	function prune_temp()
	{
		$this->db->where('UNIX_TIMESTAMP(created) <', time() - $this->config->item('DX_email_activation_expire'));
		return $this->db->delete($this->_table);
	}

	function create_temp($data)
	{
		$data['created'] = new DateTime();
		return $this->set_user_temp($data);
	}

	function set_user_temp($data)
	{
		$user_temp = New DxUsers();

		foreach ($data as $key => $value) {

			if ($key == 'username') {
				$user_temp->setUsername($value);
			} elseif ($key == 'password') {
				$user_temp->setPassword($value);
			} elseif ($key == 'email') {
				$user_temp->setEmail($value);
			} elseif ($key == 'last_ip') {
				$user_temp->setLastIp($value);
			} elseif ($key == 'created') {
				$user_temp->setCreated($value);
			}
		}

		$this->em->persist($user_temp);
		$this->em->flush();
		return TRUE;
	}

	/* ....This all function used from backend controller, which have no effect now. In future it would be used..... */

	function get_all($offset = 0, $row_count = 0)
	{
		if ($offset >= 0 AND $row_count > 0) {
			$query = $this->db->get($this->_table, $row_count, $offset);
		} else {
			$query = $this->db->get($this->_table);
		}

		return $query;
	}
}