<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("usermodel");
	}

	/**
	 * Default function that will be executed unless another method secified
	 * @return type View
	 */
	public function index()
	{
		return $this->view();
	}
}