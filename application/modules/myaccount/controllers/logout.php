<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of logout
 *
 * @author arana
 */
class logout extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Logout the currently logged in user
	 */
	public function index()
	{
		try {
			//logout the session of currently logged in user
			$this->dx_auth->logout();

			//redirect to home page
			redirect();
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}

}