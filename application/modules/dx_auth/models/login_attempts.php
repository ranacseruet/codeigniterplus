<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."models/Entities/DxLoginAttempts.php");

use \DxLoginAttempts;

class Login_Attempts extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxLoginAttempts", $this->doctrine->em);
	}

	function check_attempts($ip_address)
	{
		$criteria = array('ipAddress' => $ip_address);
		return $this->em->getRepository($this->entity)->findBy($criteria);
	}

	// Increase attempts count
	function increase_attempt($ip_address)
	{
		$login_attemp = new DxLoginAttempts();

		$login_attemp->setIpAddress($ip_address);
		$login_attemp->setTime(new DateTime());

		$this->em->persist($login_attemp);
		$this->em->flush();
		return TRUE;
	}

	function clear_attempts($ip_address)
	{
		$criteria = array('ipAddress' => $ip_address);
		$entity = $this->em->getRepository($this->entity)->findOneBy($criteria);

		if ($entity) {
			$this->em->remove($entity);
			$this->em->flush();
		}

		return TRUE;
	}
}