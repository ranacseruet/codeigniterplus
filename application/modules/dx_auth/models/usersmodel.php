<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Entities/DxUsers.php");

use \DxUsers;

class Usersmodel extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxUsers", $this->doctrine->em);

		/* ................other staff need for active record...................... */
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix . $this->config->item('DX_users_table');
		$this->_roles_table = $this->_prefix . $this->config->item('DX_roles_table');
	}

	function get_user_by_id($user_id)
	{
		$object = $this->get($user_id);
		return $object;
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
		$query = $this->em->getRepository($this->entity)->findBy($criteria);
		return $query;
	}

	function ban_user($user_id, $reason = NULL)
	{
		$data = array(
			'banned' => 1,
			'ban_reason' => $reason
		);
		return $this->set_user($user_id, $data);
	}

	function unban_user($user_id)
	{
		$data = array(
			'banned' => 0,
			'ban_reason' => NULL
		);
		return $this->set_user($user_id, $data);
	}

	function set_role($user_id, $role_id)
	{
		$data = array(
			'role_id' => $role_id
		);
		return $this->set_user($user_id, $data);
	}

	function create_user($data)
	{
		$data['created'] = new DateTime();
		$data['last_login'] = new DateTime();
		$data['modified'] = new DateTime();
		$data['banned'] = FALSE;
		$insert_id = $this->set_user(NULL, $data, "create_user");
		return $insert_id;
	}

	function set_user($user_id = NULL, $data, $extra = NULL)
	{
		if (!empty($user_id)) {
			$user = $this->get($user_id);
		} else {
			$user = new DxUsers();
		}

		foreach ($data as $key => $value) {
			if ($key == 'role_id') {
				$role = $this->roles->get($value);
				$user->setRole($role);
			} elseif ($key == 'username') {
				$user->setUsername($value);
			} elseif ($key == 'password') {
				$user->setPassword($value);
			} elseif ($key == 'email') {
				$user->setEmail($value);
			} elseif ($key == 'banned') {
				$user->setBanned($value);
			} elseif ($key == 'ban_reason') {
				$user->setBanReason($value);
			} elseif ($key == 'newpass') {
				$user->setNewpass($value);
			} elseif ($key == 'newpass_key') {
				$user->setNewpassKey($value);
			} elseif ($key == 'newpass_time') {
				$user->setNewpassTime($value);
			} elseif ($key == 'last_ip') {
				$user->setLastIp($value);
			} elseif ($key == 'last_login') {
				$user->setLastLogin($value);
			} elseif ($key == 'created') {
				$user->setCreated($value);
			} elseif ($key == 'modified') {
				$user->setModified($value);
			}
		}

		$this->em->persist($user);
		$this->em->flush();

		if ($extra == "create_user")
			return $user->getId();
		else
			return TRUE;
	}

	function delete_user($user_id)
	{
		$entity = $this->em->getPartialReference($this->entity, $user_id);
		$this->em->remove($entity);
		$this->em->flush();

		return true;
	}

	function newpass($user_id, $pass, $key)
	{
		$dateTime = new DateTime();
		$interval = new DateInterval('PT' . $this->config->item('DX_forgot_password_expire') . 'S');

		$data = array(
			'newpass' => $pass,
			'newpass_key' => $key,
			'newpass_time' => $dateTime->add($interval)
		);
		return $this->set_user($user_id, $data);
	}

	function activate_newpass($user_id, $key)
	{
		$criteria = array('id' => $user_id, 'newpassKey' => $key);
		$user = $this->em->getRepository($this->entity)->findBy($criteria);
		$data = array(
			'password' => $user->getNewpass(),
			'newpass' => NULL,
			'newpass_key' => NULL,
			'newpass_time' => NULL
		);
		return $this->set_user($user->getId(), $data);
	}

	function clear_newpass($user_id)
	{
		$data = array(
			'newpass' => NULL,
			'newpass_key' => NULL,
			'newpass_time' => NULL
		);
		return $this->set_user($user_id, $data);
	}

	function change_password($user_id, $new_pass)
	{
		$data['password'] = $new_pass;
		$data['newpass_time'] = new DateTime();
		$data['modified'] = new DateTime();
		return $this->set_user($user_id, $data);
	}

	function get_user_by_social_id($social_id, $provider)
	{
		$criteria = set_criteria_by_social_id($social_id, $provider);
		$query = $this->em->getRepository($this->entity)->findOneBy($criteria);
		return $query;
	}
}

/* ....This all function used from backend controller, which have no effect now. In future it would be used..... */

function get_all($offset = 0, $row_count = 0)
{
	$users_table = $this->_table;
	$roles_table = $this->_roles_table;

	if ($offset >= 0 AND $row_count > 0) {
		$this->db->select("$users_table.*", FALSE);
		$this->db->select("$roles_table.name AS role_name", FALSE);
		$this->db->join($roles_table, "$roles_table.id = $users_table.role_id");
		$this->db->order_by("$users_table.id", "ASC");

		$query = $this->db->get($this->_table, $row_count, $offset);
	} else {
		$query = $this->db->get($this->_table);
	}

	return $query;
}

/* ............................unused function....................... */
/*
  function check_ban($user_id)
  {
  $this->db->select('1', FALSE);
  $this->db->where('id', $user_id);
  $this->db->where('banned', '1');
  return $this->db->get($this->_table);
  }

  function get_user_field($user_id, $fields)
  {
  $this->db->select($fields);
  $this->db->where('id', $user_id);
  return $this->db->get($this->_table);
  }

 */