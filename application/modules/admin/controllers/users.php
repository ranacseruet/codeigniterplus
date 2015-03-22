<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class USers extends Admin_Controller {

	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("usermodel");
		$this->load->library('pagination');
		$this->load->library('app/paginationlib');
	}

	/**
	 * Show users list with pagination
	 * @return type View
	 */
	public function index($start_record = 0)
	{
		try {
			$pagingConfig = $this->paginationlib->initPagination("/admin/users/index", $this->usermodel->get_count());
			$this->data["pagination_helper"] = $this->pagination;

			$this->data["users"] = $this->usermodel->get_by_range($start_record, $pagingConfig['per_page']);

			return $this->view();
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}

	/**
	 * Delete a record and redirect to users list page
	 * @return view 
	 */
	public function delete()
	{
		try {
			if ($this->input->post("delete")) {
				$this->usermodel->delete($this->input->post("id"));
			}

			redirect(base_url() . "admin/users");
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}
}