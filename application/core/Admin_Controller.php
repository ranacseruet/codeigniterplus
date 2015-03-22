<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Admin_Controller
 *
 * @author Rana
 */
class Admin_Controller extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->init_admin();

		$this->load->config("pd_admin");

		$this->load->library('pagination');
		$this->load->library('app/paginationlib');

		$this->page->noindex = true;
	}

	/**
	 * Initialization for logged in admin.
	 * Redirect if logged in user is not an admin
	 */
	function init_admin()
	{
		$this->init_user("admin/");
		if (!$this->dx_auth->is_admin()) {
			redirect(base_url() . "myaccount/logout");
			exit;
		}
	}
}