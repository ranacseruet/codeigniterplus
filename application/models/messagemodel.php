<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \PdMessage;

/**
 * Message model
 * 
 * @final    Messagemodel
 * @category model
 * @author   Rana
 */
class Messagemodel extends My_DModel {

	function __construct()
	{
		parent::__construct();
		$this->init("PdMessage", $this->doctrine->em);
	}
}