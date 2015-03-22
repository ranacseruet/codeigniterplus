<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model("usermodel");
	}

	/**
	 * Search database with username and returns json data about existing username
	 * @return json message which is shown if username available or not
	 */
	function check_username_availability()
	{
		$username = $this->input->post('username');
		$user = $this->usermodel->get_by_criteria(array("username" => $username));

		if ($user && count($user) > 0) {
			echo json_encode("That name is already taken, please try another one");
		} else {
			echo json_encode(TRUE);
		}
	}

	/**
	 * Search database with username and returns json data about existing username
	 * @return json message which is shown if username available or not
	 */
	function check_email_availability()
	{
		$email = $this->input->post('email');
		$user = $this->usermodel->get_by_criteria(array("email" => $email));

		if ($user && count($user) > 0) {
			echo json_encode("That email is already taken, please try another one");
		} else {
			echo json_encode(TRUE);
		}
	}
}