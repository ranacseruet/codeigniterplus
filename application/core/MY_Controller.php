<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter MY_Controller Class
 *
 * initializes common controller settings, this is to be derived by all controllers of this application
 *
 * @name      MY_Controller
 * @category  Core Libraries
 * @author    Md. Ali Ahsan Rana
 * @link      http://codesamplez.com/
 */
class MY_Controller extends CI_Controller {

	//common prefix that will be used for point template/config files
	var $prefix = "CP_";
	var $data;
	var $page;
	var $meta;

	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->init();
		$this->data["status"] = (object) NULL;
		//$this->load->library("unit_test");
		//$this->output->enable_profiler();
		$this->load->library('app/formvalidator');
		$this->load->library("session");

		$this->data["pagination_helper"] = NULL;
		$this->data["iteration"] = NULL;
	}

	/**
	 * Initialization common template initialization codes here
	 */
	function init()
	{
		//retrieve the current class name
		$class_name = strtolower(get_class($this));

		//changing the prefix for this controller
		$this->prefix = $this->prefix . $class_name . "_";

		//changing smarty prefix as per this controller        
		$this->mysmarty->prefix = "modules/" . $class_name . "/";

		//some commn smarty declarations
		$this->mysmarty->assign("common_dir", "common/");
		$this->mysmarty->assign('base_url', base_url());
		$this->mysmarty->assign('cdn_url', $this->config->item("cdn_url")? : base_url());
		$this->mysmarty->assign('is_logged_in', isset($this->dx_auth) ? $this->dx_auth->is_logged_in() : false);
		$this->mysmarty->assign("is_admin", isset($this->dx_auth) ? $this->dx_auth->is_admin() : false);
		//set an empty message by default
		$this->mysmarty->assign('status', "");

		$this->page = (object) NULL;
		$this->page->noindex = false;
	}

	/**
	 * final view codes for showing template
	 * @param ArrayObject $data
	 * @param bool $template_only
	 */
	function view($template_only = FALSE)
	{
		//assigns all data as smarty variables. Reduces smarty assignment in controllers
		if ($this->data != NULL) {
			foreach ($this->data as $key => $value) {
				$this->mysmarty->assign($key, $value);
			}
		}

		//retrieve method name for using on the next step
		$method = $this->getFunctionName();
		$this->prefix = $this->prefix . $method . "_";
		//loading the seo_properties
		if (isset($this->page->title)) {
			$this->page->title .= $this->config->item($this->prefix . "title");
		} else {
			$this->page->title = $this->config->item($this->prefix . "title");
		}
		$this->page->title .= empty($this->page->title) ? "" : " | ";
		$this->page->title .= get_domain();

		$this->page->key = $this->config->item($this->prefix . "key");
		$this->page->desc = $this->config->item($this->prefix . "desc");

		if ($this->meta && is_array($this->meta)) {
			foreach ($this->meta as $key => $value) {
				$this->page->title = str_replace("{" . $key . "}", $value, $this->page->title);
				$this->page->desc = str_replace("{" . $key . "}", $value, $this->page->desc);
			}
		}

		//loading the seo_properties
		$this->mysmarty->page = $this->page;

		//To dispaly only template in case of asynchronous command
		if ($template_only) {
			$this->mysmarty->display($this->mysmarty->prefix . $method . ".tpl");
			exit; //to avoid showing profiler/debug info
		}
		$this->mysmarty->view($method);
	}

	/**
	 * return the name of controller method that was called. Must be called from a controller method
	 * @return type string
	 */
	protected function getFunctionName()
	{
		$backtrace = debug_backtrace();
		return $backtrace[2]['function'];
	}

	/**
	 * Initialization for logged in user.
	 * change base view/template directory and
	 * redirect if user isn't logged in 
	 */
	function init_user($start_path = "member/")
	{
		$this->mysmarty->prefix = $start_path . $this->mysmarty->prefix;
		$this->mysmarty->assign("common_dir", $start_path . "common/");
		if (!$this->dx_auth->is_logged_in()) {
			redirect();
			exit;
		}
		$this->load->model("usermodel");
	}

	/**
	 *  pagination seo 
	 *  @param int $page page_no
	 */
	function pagination_seo($page)
	{
		$this->data["page_no"] = $page;
		$this->meta["current"] = $page;
		$this->data["last_page"] = ceil($this->pagination->total_rows / $this->pagination->per_page);
		$this->meta["total"] = $this->data["last_page"];
		$this->data["page_url"] = $this->pagination->base_url;
	}
}