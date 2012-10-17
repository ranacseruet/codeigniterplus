<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* @property CI_Loader                $load
* @property CI_Form_validation       $form_validation
* @property CI_Input                 $input
* @property CI_Email                 $email
* @property Mysmarty                 $mysmarty
* @property Doctrine                 $doctrine
* @property Geoip                    $geoip
* @property Messagemodel             $messagemodel
* @property Citylib                  $citylib
*/

class Message extends MY_Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();        
        $this->load->model("messagemodel");
        $this->init_admin();
        $this->load->library('pagination');
        $this->load->library('app/mapper');

    }
   
    
    
    /**
     * Show message list with pagination
     * @return type View
     */
    public function index($start_record=0)
    {   
        try
        {
            $config['per_page']          = 20;
            $config['uri_segment']       = 4;
            $config['base_url']          = base_url()."/admin/message/index";
            $config['total_rows']        = $this->messagemodel->get_count();
            $this->pagination->initialize($config);
            $this->data["pagination_helper"]   = $this->pagination;
            
            $messages              = $this->messagemodel->get_by_range($start_record,$config['per_page']);
            $this->data["messages"] = $messages;
            return $this->view($this->data);             
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    /**
     * Show details page of the city and saves the edited information as well
     * @param integer $id
     * @return view 
     */
    public function edit($id)
    {
        
        try
        {
            $forms                  = $this->config->item("rules");
            $this->data["message_form"]      = $forms["contact"];
           
            if($this->input->post("submit")){
                
                $this->load->library('form_validation');
                $this->load->helper('form'); 
                $fv = $this->form_validation;
                $fv->set_rules($this->data["message_form"]);
                
                if($fv->run())
                {
                    $message = $this->messagemodel->get($id); 
                    //print_r($message);exit;
                    $message = $this->mapper->formToMessage($this->input,$this->data["message_form"],$message);
                    if($this->messagemodel->save($message))
                    {
                        $this->data["status"]->message = "City saved successfully";
                        $this->data["status"]->success = TRUE;
                    }
                    else
                    {
                        //@todo Valid data, but wasn't save to db
                    }
                }
                else 
                {
                    $this->data["status"]->message = validation_errors();
                    $this->data["status"]->success = FALSE;  
                }
            }

            $this->data["message"]       = $this->messagemodel->get($id);
            $this->data["action_url"] = base_url()."admin/message/edit/".$id;

            return $this->view($this->data);
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    /**
     * Sow blank details page for adding new record,
     * process submission.
     * @return view 
     */
    public function add()
    {
        
        try
        {
            $forms                = $this->config->item("rules");
            $this->data["message_form"]    = $forms["contact"];

            if($this->input->post("submit")){
                $this->load->library('form_validation');
                $this->load->helper('form'); 
                $fv = $this->form_validation;
                $fv->set_rules($this->data["message_form"]);

                if($fv->run())
                {
                    $message = $this->mapper->formToMessage($this->input,$this->data["message_form"]);
                    if($this->messagemodel->save($message))
                    {
                        $this->data["status"]->message = "Message added successfully";
                        $this->data["status"]->success = TRUE;
                    }
                    else 
                    {
                        //@todo validated, but can't save data to db
                        
                    }
                }
                else 
                {
                    $this->data["status"]->message = validation_errors();
                    $this->data["status"]->success = FALSE;  
                }
            }

            $this->data["action_url"] = base_url()."admin/message/add";
            $this->data["message"]       = new PdContact();
            return $this->view($this->data);
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }
    
    /**
     *Delete a record and redirect to city list page
     * @return view 
     */
    public function delete()
    {
        try 
        { 
            if($this->input->post("delete")){
                $this->messagemodel->delete($this->input->post("id"));
            }

            redirect(base_url()."admin/message");        
        }
        catch (Exception $err)
        {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
            
    }
    
}
/* End of file city.php */
/* Location: ./application/modules/controllers/admin/city.php */