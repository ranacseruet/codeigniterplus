<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Contains common functionality for CRUD Operation
 *
 * @final    My_Model
 * @category models 
 * @author   Md. Ali Ahsan Rana
 * @link     http://codesamplez.com
 */
class My_DModel extends CI_Model {

	/**
	 * @var \Doctrine\ORM\EntityManager $em
	 */
	var $em;
	var $entity;

	/**
	 *
	 * @param int $id
	 * @return DxUsers 
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Initialize with entity name and entity manager
	 * @param type $entity
	 * @param type $em 
	 */
	function init($entity, $em)
	{
		$this->entity = $entity;
		$this->em = $em;
	}

	/**
	 * Retrieve a single record according to given identifer
	 * @param type $id identifier of the record
	 * @return type 
	 */
	function get($id)
	{
		try {
			$object = $this->em->find($this->entity, $id);
			return $object;
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return NULL;
		}
	}

	/**
	 * Return all records for an entity
	 * @return type 
	 */
	function get_all()
	{
		try {
			return $this->em->getRepository($this->entity)->findAll();
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return NULL;
		}
	}

	/**
	 * Return list of recors according to given start index and length
	 * @param type $start the start index number for the city list
	 * @param type $length Determines how many records to fetch
	 * @return type 
	 */
	function get_by_range($start = 1, $length = 10, $criteria = array(), $orderBy = NULL)
	{
		try {
			return $this->em->getRepository($this->entity)->findBy($criteria, $orderBy, $length, $start);
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			print_r($err->getMessage());
			exit();
			return NULL;
		}
	}

	/**
	 * Return the number of records
	 * @return integer 
	 */
	function get_count()
	{
		try {
			$query = $this->em->createQueryBuilder()
					->select("count(c)")
					->from($this->entity, "c")
					->getQuery();
			return $query->getSingleScalarResult();
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return 0;
		}
	}

	/**
	 * Save an enitity(insert for new one)
	 * @param type $entity Docrine Entity object
	 * @return boolean 
	 */
	function save($entities)
	{
		try {
			if (is_array($entities)) {
				foreach ($entities as $entity) {
					$this->em->persist($entity);
				}
			} else {
				$this->em->persist($entities);
			}
			$this->em->flush();
			return TRUE;
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return FALSE;
		}
	}

	/**
	 * Delete an Entity according to given (list of) id(s)
	 * @param type $ids array/single
	 * @return boolean
	 */
	function delete($ids)
	{
		try {
			if (!is_array($ids)) {
				$ids = array($ids);
			}
			foreach ($ids as $id) {
				$entity = $this->em->getPartialReference($this->entity, $id);
				$this->em->remove($entity);
			}
			$this->em->flush();
			return TRUE;
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return FALSE;
		}
	}

	/**
	 * Retrieve a single record according to given criteria
	 * @param type array $criteria
	 * @return type 
	 */
	function get_by_criteria($criteria)
	{
		try {
			$query = $this->em->getRepository($this->entity)->findOneBy($criteria);
			return $query;
		} catch (Exception $err) {
			log_message("error", $err->getMessage(), false);
			return NULL;
		}
	}
}