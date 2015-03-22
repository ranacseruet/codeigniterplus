<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of logout
 *
 * @author arana
 */
class User extends User_Controller {

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("usermodel");
		$this->user_id = $this->dx_auth->get_user_id();
	}

	/**
	 * Default function that will be executed unless another method secified
	 */
	public function index()
	{
		try {
			//Info of currently logged in user is succefully retrieved
			$this->meta["user"] = $this->data["user"] = $this->dx_auth->get_username();
			
			return $this->view();
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}
}