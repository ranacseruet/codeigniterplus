<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User_Controller
 *
 * @author Rana
 */
class User_Controller extends MY_Controller {

	var $user;
	var $profile;

	function __construct()
	{
		parent::__construct();

		$this->init_user("member/");
		$this->init_profile();

		$this->load->config("pd_user");

		$this->page->noindex = true;
	}

	function init_profile()
	{
		//Redirect user to basic profile page if profile doesn't exist

		$this->user = $this->usermodel->get($this->dx_auth->get_user_id());

		if (empty($this->user)) {
			//If user info no found
			return redirect(base_url() . "myaccount/logout");
		}

		$this->profile = $this->user->getUserProfile();

		//Info of currently logged in user is succefully retrieved
		$this->data["user"] = $this->user;
		$this->data["profile"] = $this->profile;
	}
}