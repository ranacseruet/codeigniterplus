<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader                $load
* @property CI_Form_validation       $form_validation
* @property CI_Input                 $input
* @property CI_Email                 $email
* @property Mysmarty                 $mysmarty
* @property Doctrine                 $doctrine
* @property Geoip                    $geoip
* @property usermodel                $usermodel

*/

class USers extends MY_Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();        
        $this->load->model("usermodel");
        $this->init_admin();
        $this->load->library('pagination');

    }
   
    
    
    /**
     * Show users list with pagination
     * @return type View
     */
    public function index($start_record=0)
    {   
        try
        {
            $config['per_page']          = 20;
            $config['uri_segment']       = 4;
            $config['base_url']          = base_url()."admin/users/index";
            $config['total_rows']        = $this->usermodel->get_count();
            $this->pagination->initialize($config);
            $data["pagination_helper"]   = $this->pagination;
            
            $data["users"]              = $this->usermodel->get_by_range($start_record,$config['per_page']);

            return $this->view($data);             
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
   
    /**
     *Delete a record and redirect to users list page
     * @return view 
     */
    public function delete()
    {
        try 
        { 
            if($this->input->post("delete")){
                //print_r($this->input->post("id"));exit;
                $this->usermodel->delete($this->input->post("id"));
            }

            redirect(base_url()."admin/users");        
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
            
    }
    
}
/* End of file users.php */
/* Location: ./application/modules/controllers/admin/users.php */