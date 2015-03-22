<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Entities/DxUserAutologin.php");

use \DxUserAutologin;

class User_Autologin extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxUserAutologin", $this->doctrine->em);
	}

	function store_key($key, $user_id)
	{
		$user = new DxUserAutologin();

		$user->setKeyId(md5($key));
		$dxuser = $this->users->get($user_id);
		$user->setUser($dxuser);
		$user->setUserAgent(substr($this->input->user_agent(), 0, 149));
		$user->setLastIp($this->input->ip_address());
		$user->setLastLogin(new DateTime());
		$this->em->persist($user);
		$this->em->flush();

		return TRUE;
	}

	function get_key($key, $user_id)
	{
		$user = $this->users->get($user_id);
		$data = array(
			'keyId' => md5($key),
			'user' => $user
		);

		$autologin_user = $this->em->getRepository($this->entity)->findOneBy($data);
		if ($autologin_user) {
			return $autologin_user->getUser();
		} else {
			return NULL;
		}
	}

	function delete_key($key, $user_id)
	{
		$user = $this->users->get($user_id);
		$data = array(
			'keyId' => md5($key),
			'user' => $user
		);

		$entity = $this->em->getRepository($this->entity)->findOneBy($data);

		if ($entity) {
			$this->em->remove($entity);
			$this->em->flush();
		}

		return TRUE;
	}

	function clear_keys($user_id)
	{
		$user = $this->users->get($user_id);
		$criteria = array('user' => $user);
		$entity = $this->em->getRepository($this->entity)->findOneBy($criteria);

		if ($entity) {
			$this->em->remove($entity);
			$this->em->flush();
		}

		return TRUE;
	}

	function prune_keys($user_id)
	{
		$user = $this->users->get($user_id);
		$data = array(
			'user' => $user,
			'userAgent' => substr($this->input->user_agent(), 0, 149),
			'lastIp' => $this->input->ip_address()
		);

		$entity = $this->em->getRepository($this->entity)->findOneBy($data);

		if ($entity) {
			$this->em->remove($entity);
			$this->em->flush();
		}

		return TRUE;
	}
}