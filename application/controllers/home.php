<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("messagemodel");
		$this->load->language("message");
	}

	/**
	 * Default function that will be executed unless another method secified
	 * @return type View
	 */
	public function index()
	{
		return $this->view();
	}

	/**
	 * Is called when a 404 server error occurs
	 * @return type View
	 */
	public function error()
	{
		return $this->view();
	}

	/**
	 * Controller For 'Contact Page'
	 * @return type View
	 */
	public function contact()
	{
		try {
			$forms = $this->config->item("rules");
			$this->data["contact_form"] = $forms["contact"];

			if ($this->input->post('submit')) {

				$this->load->library("app/formvalidator");
				$this->load->library("app/mapper");

				if ($this->formvalidator->isValid("contact")) {

					$message = $this->mapper->formToMessage($this->input, $this->data["contact_form"], null);
					$this->messagemodel->save($message);

					$this->data["status"]->message = $this->lang->line("message_sent");
					$this->data["status"]->success = TRUE;
				} else {
					$this->data["status"]->message = validation_errors();
					$this->data["status"]->success = FALSE;
				}
			}

			return $this->view();
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}

	/**
	 * Secret function, to create/update database schema from doctrine entities
	 * @param type $mode
	 * @return type
	 */
	function db_schema($mode = "update")
	{
		try {
			$this->em = $this->doctrine->em;

			$tool = new \Doctrine\ORM\Tools\SchemaTool($this->em);

			$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
			$cmf->setEntityManager($this->em);
			$metadata = $cmf->getAllMetadata();

			if ($mode == "create") {
				$queries = $tool->getCreateSchemaSql($metadata);
			} else {
				$queries = $tool->getUpdateSchemaSql($metadata);
			}
			echo "Total queries: " . count($queries) . "<br /><br />";
			for ($i = 0; $i < count($queries); $i++) {
				$this->db->query($queries[$i]);
				echo $queries[$i] . "<br /><br />Execution Successfull: " . ($i + 1) . "<br /><br />";
			}
		} catch (Exception $err) {
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}
}