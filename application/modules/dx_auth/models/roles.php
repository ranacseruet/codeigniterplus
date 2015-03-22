<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("DxRoles", $this->doctrine->em);
	}

	function get_all()
	{
		$query = $this->em->getRepository($this->entity)->findAll();
		return $query;
	}

	function get_role_by_id($role_id)
	{
		return $this->get($role_id);
	}

	function get_role_by_name($role_name)
	{
		return $this->em->getRepository($this->entity)->findOneBy(array("name" => $role_name));
	}

	function create_role($name, $parent_id = 0)
	{
		$roles = New DxRoles;
		$roles->setName($name);
		$roles->setParentId($parent_id);
		$this->em->persist($roles);
		$this->em->flush();

		return $roles->getId();
	}

	function delete_role($role_id)
	{
		$entity = $this->em->getPartialReference($this->entity, $role_id);
		$this->em->remove($entity);
		$this->em->flush();
	}
}