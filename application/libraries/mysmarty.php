<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter MySmarty Class
 *
 * initializes basic smarty settings and act as smarty object
 *
 * @final    Mysmarty 
 * @category Libraries
 * @author   Md. Ali Ahsan Rana
 * @link     http://codesamplez.com/
 */
class Mysmarty extends Smarty {

	//object with title/key/desc property
	var $page;
	//for point to the correct template file
	var $prefix;

	/**
	 * constructor
	 */
	function __construct()
	{
		parent::__construct();
		$this->template_dir = realpath(APPPATH . "/views/");
		$this->config_dir = realpath(APPPATH . "/conf/");
		$this->compile_dir = realpath(APPPATH . "/cache/");
		//$this->clearAllCache();
		$this->caching = 0;
	}

	/**
	 * Replace the traditional codeigniter's view method
	 * @param string $content Template to display
	 * @return none
	 */
	function view($content)
	{
		$this->assign('page', $this->page);
		$this->assign('content', $this->prefix . "{$content}");
		$this->display('index.tpl');
	}
}